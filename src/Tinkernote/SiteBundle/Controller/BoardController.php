<?php

namespace Tinkernote\SiteBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Tinkernote\SiteBundle\Entity\Annonce;
use Tinkernote\SiteBundle\Entity\Status;
use Tinkernote\SiteBundle\Form\AnnonceType;
use Tinkernote\SiteBundle\Form\StatusType;


class BoardController extends Controller {

    public function indexAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();

        $abonnement_repository          = $em->getRepository('SiteBundle:Abonnement');
        $annonces_repository            = $em->getRepository('SiteBundle:Annonce');
        $activity_repository            = $em->getRepository('SiteBundle:Activity\AnnonceActivity');
        $annonce_activity_repository    = $em->getRepository('SiteBundle:Activity\CommentActivity');
        $abonnement_activity_repository = $em->getRepository('SiteBundle:Activity\AbonnementActivity');

        $status_repository   = $em->getRepository('SiteBundle:Status');
        $user_repository     = $em->getRepository('UserBundle:User');
        $stats               = $this->get('stats.service')->allstats($user);
        $countOnlineUsers    = $this->get('stats.service')->countOnlineUsers();
        $countAbonnement     = $abonnement_repository->countAbonnement($user);

        $lastAnnonces        = $annonces_repository->findBy(array('user'  => $user->getId()),    array('date' => 'DESC'), null);
        $lastAnnonces_region = $annonces_repository->findExceptedMe($user);
        $lastAbonnement      = $abonnement_activity_repository->getAbonnementActivity($user);

        $lastStatus          = $status_repository->findBy(  array('user'  => $user->getId()),    array('date' => 'DESC'), 4);
        $lastActivity        = $activity_repository->findBy(array('owner' => $user->getId()),    array('date' => 'DESC'), 4);
        $lastActivityComment = $annonce_activity_repository->getAll($user);

        $myAbonnement       = $abonnement_repository->findBy(array('follower' => $user->getId()));

        $userPropose         = $this->userFollowPropose($user, $user_repository, $em);

        $merged              = $this->mergeAnnonces($lastAnnonces, $lastAnnonces_region); // Permetra le merge des annonces des abonnés

        $merged_activity     = $this->mergeActivityAnnonces($lastActivity, $lastActivityComment, $lastStatus, $lastAbonnement);

        return $this->render('SiteBundle:Board:board.html.twig', array('last_region_activity' => $lastAnnonces_region,
                                                                        'last_annonces'        => $lastAnnonces,
                                                                        'last_activity'        => $merged_activity,
                                                                        'stats'                => $stats,
                                                                        'countOnlineUsers'     => $countOnlineUsers,
                                                                        'userPropose'          => $userPropose,
                                                                        'nb_abonnement'        => $countAbonnement,
                                                                        'myAbonnement'         => $myAbonnement

        ));
    }

    public function editAnnonceAction(Request $request, Annonce $id)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('SiteBundle:Annonce');

        $annonce    = $repository->find($id);

        if(!$annonce){
            throw new NotFoundHttpException('Impossible d\'editer cette annonce parce qu\'elle n\'existe pas');
        } // A retirer éventuellement du script si Annonce $id suffit réellement au controle
        if($annonce->getUser()->getId() != $user->getId())
        {
            throw new AccessDeniedException('Vous n\'avez pas la possibilité d\'éditer cette annonce');
        }

        $form       = $this->createForm(new AnnonceType($em, $this->get('security.context'), $annonce));

        $form->setData($annonce);

        if($request->isMethod('POST')){
            $form->handleRequest($request);

            $em->persist($annonce);
            $em->flush();

            $response = $this->redirect($this->generateUrl('bloc_homepage'));

            return $response;
        }

        $response = $this->render('SiteBundle:Board/Annonce:edit_annonce.html.twig', array('form' => $form->createView(),
                                                                                            'annonce' => $annonce ));

        return $response;
    }

    public function deleteAnnonceAction(Request $request, Annonce $id){
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('SiteBundle:Annonce');
        $annonce    = $repository->find($id);

        if(!$annonce){
            throw new NotFoundHttpException('Impossible de supprimer cette annonce parce qu\'elle n\'existe pas');
        } // A retirer éventuellement du script si Annonce $id suffit réellement au controle

        if($annonce->getUser()->getId() != $user->getId()) {
            throw new AccessDeniedException('Vous n\'avez pas la possibilité de supprimer cette annonce');
        }

        //$em->remove($annonce);
        //$em->flush();

        $this->get('session')->getFlashBag()->add('notice','Votre annonce a été supprimée!');

        $response = $this->redirect($this->generateUrl('bloc_homepage'));

        return $response;
    }

    public function ajaxWhatsUpAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $status = new Status();

        $form = $this->createForm(new StatusType(), $status);

        if($request->isMethod('POST')){

            $form->handleRequest($request);

           if($form->isValid()){
                $em = $this->getDoctrine()->getManager();

                $status->setUser($user);
                $em->persist($status);
                $em->flush($status);

                $this->get('session')->getFlashBag()->add('notice','Votre status à été mis à jour!');
                $response =  $this->redirect($this->generateUrl('bloc_homepage'));

                return $response;
           }
        }

        $response = $this->render('SiteBundle:Board/Template/Form:form_whatUp.html.twig', array('form_status' => $form->createView()));

        return $response;
    }

    private function mergeAnnonces($lastAnnonces, $lastAnnonces_region)
    {
        $allAnnonces = array_merge($lastAnnonces, $lastAnnonces_region); // Mix les 2 repertoires d'annonces
        usort($allAnnonces, array($this, 'trie_par_date') );

        return $allAnnonces;

    }

    private function mergeActivityAnnonces($lastActivity, $lastActivityComment, $lastStatus, $lastAbonnement)
    {
        $allActivity = array_merge($lastActivity, $lastActivityComment, $lastStatus, $lastAbonnement); // Mix les 4 repertoires d'annonces par date
        usort($allActivity, array($this, 'trie_par_date'));

        return $allActivity;
    }

    private function trie_par_date($a, $b) {
        $date1 = strtotime($a->getDate()->format('r'));
        $date2 = strtotime($b->getDate()->format('r'));
        return $date1 < $date2 ;
    }

    private function userFollow($em, $user){

        $abonnement_repository =  $em->getRepository('SiteBundle:Abonnement');
        $liste                 = $abonnement_repository->findBy(array('follower' => $user->getId()));

        $new_liste = array();
        foreach($liste as $row ){
            $new_liste[] = $row->getFollowed()->getId();
        }

        return $new_liste;
    }

    private function userFollowPropose($user, $user_repository, $em){

        $liste_followed = $this->userFollow($em, $user);

        if(!$liste_followed)
        {
            return $user_repository->findAll();
        }

        $unfollowed     = $user_repository->getAllUnfollowed($user, $liste_followed);

        return $unfollowed;
    }

} 