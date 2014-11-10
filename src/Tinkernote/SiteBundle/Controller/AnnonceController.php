<?php

namespace Tinkernote\SiteBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Tinkernote\SiteBundle\Entity\Annonce;
use Tinkernote\SiteBundle\Entity\Comment;
use Tinkernote\SiteBundle\Form\AnnonceType;
use Tinkernote\SiteBundle\Form\CommentType;

class AnnonceController extends Controller {

    public function indexAction() {
        $annonces = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')->findBy(array(), array('id' => 'desc'));
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array( 'annonces' => $annonces,
                                                                            'recherche' => "Toute la france",
                                                                            'form_search' => null,
                                                                            'form_search_region' => null));
    }

    public function showAction(Request $request, Annonce $id){

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('SiteBundle:Annonce')->findOneBy(array('id' => $id));

        $activity_manager = $this->get('activity.service');
        $activity_manager->updateAnnonceActivity($id, $annonce->getUser(), 1);

        $annonceComments = $em->getRepository('SiteBundle:Comment')->findBy(array('annonce' => $id));

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

                $response = $this->redirect($this->generateUrl('annonce_show', array('id' => $id->getId())));

                return $response;
            }

            $response = $this->redirect($this->generateUrl('annonce_show', array('id' => $id->getId())));

            return $response;
        }

        return $this->render('SiteBundle:Annonce/Show:show.html.twig', array('annonce'              => $annonce,
                                                                             'form_comment'         => $form->createView(),
                                                                             'form_comment_second'  => $form_second->createView(),
                                                                             'comments'             => $annonceComments));
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

        $annonces     = $em->getRepository('SiteBundle:Annonce')->findBy(array('ville' => $ville_id->getId()), array('id' => 'desc'));
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array( 'annonces' => $annonces,
            'recherche' => $ville,
            'form_search' => null,
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


}