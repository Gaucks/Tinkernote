<?php

namespace Tinkernote\SiteBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Tinkernote\SiteBundle\Entity\Annonce;
use Tinkernote\SiteBundle\Form\AnnonceType;

class AnnonceController extends Controller {

    public function indexAction() {
        $annonces = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')->findAll();
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array('annonces' => $annonces, 'recherche' => "Toute la france"));
    }

    public function showAction(Annonce $id){

        $annonce = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')->findOneBy(array('id' => $id));
        return $this->render('SiteBundle:Annonce/Show:show.html.twig', array('annonce' => $annonce));
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
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array('annonces' => $annonces, 'recherche' => $categorie));
    }

    public function villeAction($ville) {
        $em = $this->getDoctrine()->getManager();
        $ville_id = $em->getRepository('SiteBundle:Ville')->findOneBySlug($ville);

        $annonces     = $em->getRepository('SiteBundle:Annonce')->findBy(array('ville' => $ville_id->getId()));
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array('annonces' => $annonces, 'recherche' => $ville));
    }
}