<?php

namespace Tinkernote\SiteBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class BoardController extends Controller {

    public function indexAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();

        $annonces_repository = $em->getRepository('SiteBundle:Annonce');
        $activity_repository = $em->getRepository('SiteBundle:Activity\AnnonceActivity');

        $lastAnnonces = $annonces_repository->findBy(array('user'  => $user->getId()), array('date' => 'DESC'), 5);
        $lastActivity = $activity_repository->findBy(array('owner' => $user->getId()), array('date' => 'DESC'), 5);
        $stats        = array('vente_total' => 4, 'encours' => 30 );

        return $this->render('SiteBundle:Board:board.html.twig', array('last_annonces' => $lastAnnonces,
                                                       'last_activity' => $lastActivity,
                                                       'stats'         => $stats
        ));
    }

} 