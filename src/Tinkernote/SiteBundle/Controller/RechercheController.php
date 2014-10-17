<?php

namespace Tinkernote\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Tinkernote\SiteBundle\Form\RecherchePrincipalType;
use Tinkernote\SiteBundle\Form\RechercheType;

class RechercheController extends Controller {

    /**
     * @param Request $request
     * @return Le moteur de recherche de la page d'accueil
     */
    public function rechercheTraitementAction(Request $request)
    {
        $form = $this->createForm(new RechercheType());

        $form->handleRequest($request);

        if($request->isMethod('POST'))
        {
            $recherche =  $form['recherche']->getData();
            $region    =  $form['region']->getData();

            $moteur_recherche = $this->get('recherche.service');

            /**
             * Recherche est rempli
             * Region est rempli
             */
            if(($recherche != NULL) AND ($region == NULL))
            {
                $annonces =  $moteur_recherche->findByWord($recherche);
            }

            /**
             * Recherche est rempli
             * Region est rempli
             */
            if(($recherche != NULL) AND ($region != NULL) )
            {
                $annonces = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')->findBy(array('annonces' => $annonces));
            }

            /**
             * Recherche est NULL
             * Region est rempli
             */
            if(($recherche == NULL) AND ($region != NULL))
            {
                $annonces = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')->findBy(array('region' => $region));
            }

            /**
             * Recherche est NULL
             * Region est NULL
             */
            if(($recherche == NULL) AND ($region == NULL))
            {
                return $this->redirect($this->generateUrl('annonce_homepage'));
            }

            return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array('annonces' => $annonces));
        }

        return $this->redirect($this->generateUrl('annonce_homepage'));
    }

    /**
     * @param Request $request
     * @return Le moteur de recherche dans les pages annonces
     * Plus d'options incluse
     * Categories / Regions
     */
    public function recherchePrincipalAction(Request $request)
    {
        $form = $this->createForm(new RecherchePrincipalType());

        $form->handleRequest($request);

        if($request->isMethod('POST'))
        {
            $recherche =  $form['recherche']->getData();
            $region    =  $form['region']->getData();

            $moteur_recherche = $this->get('recherche.service');

            /**
             * Recherche est rempli
             * Region est rempli
             */
            if(($recherche != NULL) AND ($region == NULL))
            {
                $annonces =  $moteur_recherche->findByWord($recherche);
            }

            /**
             * Recherche est rempli
             * Region est rempli
             */
            if(($recherche != NULL) AND ($region != NULL) )
            {
                $annonces = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')->findBy(array('annonces' => $annonces));
            }

            /**
             * Recherche est NULL
             * Region est rempli
             */
            if(($recherche == NULL) AND ($region != NULL))
            {
                $annonces = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')->findBy(array('region' => $region));
            }

            /**
             * Recherche est NULL
             * Region est NULL
             */
            if(($recherche == NULL) AND ($region == NULL))
            {
                return $this->redirect($this->generateUrl('annonce_homepage'));
            }

            return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array('annonces' => $annonces));
        }


        return $this->render('SiteBundle:Site/Template:search_annonce.html.twig', array('form' => $form->createView()));
    }

}