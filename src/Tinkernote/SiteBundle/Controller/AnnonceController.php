<?php

namespace Tinkernote\SiteBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Constraints\Null;
use Tinkernote\SiteBundle\Entity\Annonce;
use Tinkernote\SiteBundle\Entity\Comment;
use Tinkernote\SiteBundle\Form\AnnonceType;
use Tinkernote\SiteBundle\Form\CommentType;

class AnnonceController extends Controller {

    public function indexAction() {

        // Récupération de l'utilisateur connecté ou non
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            $user       = null;
        }

        // Les variables nécessaires au controller
        $em                  = $this->getDoctrine()->getManager(); // Doctrine
        $abonnement_services = $this->get('abonnement.service'); // Le services de gestion des abonnements
        $region              = $em->getRepository('SiteBundle:Region')->findOneById(29); // Récupération de l'objet complet Region()
        $region_followed     = $abonnement_services->isRegionFollower($user, $region->getId()); // Controlle si l'utilisateur est abonné a cette région true ou false
        $proposition         = $abonnement_services->getProposition($user, $region); // Les propositions de nouveaux abonnement Limiter à 5
        $annonces            = $em->getRepository('SiteBundle:Annonce')->findBy(array(), array('id' => 'desc')); // On recupere toutes les annonces concernées

        if(!$proposition or count($proposition) <= 5)
        {
            $userFollowed   = $em->getRepository('SiteBundle:Abonnement')->followed($user);

            // Créer un array() pour pouvoir trier dans les propositions
            // les utilisateurs que l'ont à déja en abonnement
            $userFollowed_liste = array();
            foreach($userFollowed as $row ){
                $userFollowed_liste[] = $row->getFollowed()->getId();
            }

            // Récupération des proposition
            $proposition    = $em->getRepository('UserBundle:User')->findUserToPropose($user, $userFollowed_liste);

            // Si l'utilisateur n'est pas connecté
            // On ajoute 5 propositions pour meublé est
            // Proposer l'abonnement
            if(!$user)
            {
                $proposition = $em->getRepository('UserBundle:User')->findBy(array(), array(), 5);
            }
        }

        // La réponse
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array( 'annonces'           => $annonces,
                                                                                            'recherche'          => $region->getNom(),
                                                                                            'form_search'        => null,
                                                                                            'abonner'            => $region_followed,
                                                                                            'region_id'          => $region->getId(),
                                                                                            'form_search_region' => null,
                                                                                            'proposition'        => $proposition));
    }

    public function showAction(Request $request, Annonce $id){

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('SiteBundle:Annonce')->findOneBy(array('id' => $id));
        $isFriend = null;

        if(!$annonce){
            throw new NotFoundHttpException('On à pas trouver');
        }

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            $user = null;
        }

        $activity_manager = $this->get('activity.service');
        $activity_manager->updateAnnonceActivity($id, $annonce->getUser(), 1, null);

        $annonceComments = $em->getRepository('SiteBundle:Comment')->findBy(array('annonce' => $id));

        if($user != null)
        {
            $isFriend = $em->getRepository('SiteBundle:Abonnement')->findOneBy( array('follower' => $user->getId(), 'followed' => $annonce->getUser()->getId()));
        }

        // Formulaire des commentaires
        $comment = new Comment();
        $comment->setAnnonce($id);

        // Création du formulaire
        $form = $this->createForm(new CommentType($this->get('security.context')), $comment);
        $form_second = $this->createForm(new CommentType($this->get('security.context')), $comment);

        if($request->isMethod('POST')){

            $user = $this->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }

            $form->handleRequest($request);
            $form_second->handleRequest($request);

            if($form->isValid() or $form_second->isValid()){

                $comment->setUser($user);
                $em->persist($comment);
                $em->flush();

                $activity_manager->updateAnnonceActivity($id, $annonce->getUser(), 2, $comment);
                $response = $this->redirect($this->generateUrl('annonce_show', array('id' => $id->getId())));

                return $response;
            }

            $response = $this->redirect($this->generateUrl('annonce_show', array('id' => $id->getId())));

            return $response;
        }

        return $this->render('SiteBundle:Annonce/Show:show.html.twig', array('annonce'             => $annonce,
                                                            'form_comment'         => $form->createView(),
                                                            'form_comment_second'  => $form_second->createView(),
                                                            'comments'             => $annonceComments,
                                                            'isFriend'            => $isFriend));
    }

    public function addAction(Request $request){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $annonce = new Annonce();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new AnnonceType($em, $this->get('security.context')), $annonce);

        $form->get('postal')->setData($user->getVille()->getPostal());

        if($request->isMethod('POST')){

            $form->handleRequest($request);

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $annonce->setUser($user);
                $em->persist($annonce);
                $em->flush();

                $response = $this->redirect($this->generateUrl('annonce_show', array('id' => $annonce->getId())));

                return $response;
            }
            return $this->render('SiteBundle:Annonce/Add:add.html.twig', array('form' => $form->createView()));
        }

        return $this->render('SiteBundle:Annonce/Add:add.html.twig', array('form' => $form->createView()));
    }

    public function categorieAction($categorie) {
        $em = $this->getDoctrine()->getManager();
        $categorie_id = $em->getRepository('SiteBundle:Category')->findOneByCategory($categorie);

        $annonces     = $em->getRepository('SiteBundle:Annonce')->findBy(array('category' => $categorie_id->getId()));
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array( 'annonces' => $annonces,
            'recherche' => $categorie,
            'form_search' => null,
            'form_search_region' => null));
    }

    public function villeAction($ville) {

        $em = $this->getDoctrine()->getManager();
        $ville_id = $em->getRepository('SiteBundle:Ville')->findOneBySlug($ville);

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            $user       = null;
        }

        if($user){
            $abonner    = null;
            $region_id = $ville_id->getDepartement()->getRegion();

            $abo_region = $em->getRepository('SiteBundle:AbonnementRegion')->findOneBy(
                            array('user'    => $user->getId(),
                                  'region'  => $ville_id->getDepartement()->getRegion()));
            if($abo_region)
            {
                $abonner = true;
            }
        }

        $annonces     = $em->getRepository('SiteBundle:Annonce')->findBy(array('ville' => $ville_id->getId()), array('id' => 'desc'));
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array( 'annonces' => $annonces,
            'recherche' => $ville,
            'form_search' => null,
            'abonner'     => $abonner,
            'region_id'     => $region_id,
            'form_search_region' => $ville_id));
    }

    public function regionAction($region) {
        $em = $this->getDoctrine()->getManager();
        $region_obj = $em->getRepository('SiteBundle:Region')->findOneBySlug($region);

        $annonces     = $em->getRepository('SiteBundle:Annonce')->rechercher(null, $region_obj->getId(), null);
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array( 'annonces' => $annonces,
            'recherche' => $region,
            'form_search' => null,
            'form_search_region' => $region_obj));
    }

    public function UserAnnonceAction($id) {

        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository('SiteBundle:Annonce')->findBy(array('user' => $id), array('date' => 'desc'));

        $username = $em->getRepository('UserBundle:User')->find($id);

        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array( 'annonces' => $annonces,
            'recherche' => "Toute la france",
            'form_search' => $username->getUsername(),
            'form_search_region' => null));
    }

}