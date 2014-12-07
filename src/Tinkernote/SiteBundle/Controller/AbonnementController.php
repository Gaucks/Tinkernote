<?php

namespace Tinkernote\SiteBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Tinkernote\SiteBundle\Entity\Abonnement;
use Tinkernote\SiteBundle\Entity\Activity\AbonnementActivity;
use Tinkernote\UserBundle\Entity\User;

class AbonnementController extends Controller
{
    public function indexAction(User $followed)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();

        $check = $em->getRepository('SiteBundle:Abonnement')->findBy(array('followed' => $followed,'follower' => $user));

        if(!$check){
            $abonnement = new Abonnement();
            $abonnement->setFollower($user)->setFollowed($followed);

            $em->persist($abonnement);
            $em->flush();

            $followed_name = $followed->getUsername();

            $this->get('session')->getFlashBag()->add('notice', ' '.$followed_name.' a bien été ajouté à votre liste d\'abonnement');

            $this->updateActivity($em, $followed, $user);

            $response = $this->redirect($this->generateUrl('bloc_homepage'));

            return $response;
        }

        throw new AccessDeniedException('Vous etes déja abonné');
    }

    public function desabonnementAction(Request $request, User $followed)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $checkAbo = $em->getRepository('SiteBundle:Abonnement')->findOneBy(array('follower' => $user->getId(), 'followed' => $followed));

        if($checkAbo){

            $em->remove($checkAbo);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', ' '.$followed->getUsername().' a bien été retiré de votre liste d\'abonnement');

            $this->updateRemoveActivity($em, $followed,$user);

            // Créons nous-mêmes la réponse en JSON, grâce à la fonction json_encode()
            $response = new JsonResponse();

            // Ici, nous définissons le Content-type pour dire que l'on renvoie du JSON et non du HTML
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }

        throw new EntityNotFoundException('Cette relation n\'existe pas');

    }

    public function myAbonnementAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('SiteBundle:Abonnement');

        $myAbonnement = $repository->findBy(array('follower' => $user->getId()));

        return $this->render('SiteBundle:Board/Abonnement:board_user_abonnement.html.twig', array('myAbonnement' => $myAbonnement) );
    }

    private function updateActivity($em, $followed, $follower){
        $activity = new AbonnementActivity();

        $activity->setFollowed($followed)
                 ->setFollower($follower);

        $em->persist($activity);
        $em->flush();

        return true;

    }

    private function updateRemoveActivity($em, $followed, $user){

        $activity = $em->getRepository('SiteBundle:Activity\AbonnementActivity')
                       ->findOneBy(array('follower' => $user->getId(), 'followed' => $followed));

        if($activity){

            $em->remove($activity);
            $em->flush();

            return true;
        }

        throw new EntityNotFoundException('Cette relation n\'existe pas');
    }

    public function getRefererRoute(Request $request)
    {
        //look for the referer route
        $referer = $request->headers->get('referer');
        $lastPath = substr($referer, strpos($referer, $request->getBaseUrl()));
        $lastPath = str_replace($request->getBaseUrl(), '', $lastPath);

        $matcher = $this->get('router')->getMatcher();
        $parameters = $matcher->match($lastPath);
        $route = $parameters['_route'];

        return $route;
    }
}
