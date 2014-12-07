<?php

namespace Tinkernote\SiteBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Tinkernote\SiteBundle\Form\RechercheHeaderType;
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
            $category  =  null;

            if(($recherche == NULL) AND ($region == NULL))
            {
                return $this->redirect($this->generateUrl('annonce_homepage'));
            }

            $annonces =  $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')
                ->rechercher($recherche, $region, $category);

            return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array( 'annonces'           => $annonces,
                                                                                'form_search'        => $recherche,
                                                                                'form_search_region' => $region
            ));
        }

        return $this->redirect($this->generateUrl('annonce_homepage'));
    }

    /**
     * @param Request $request
     * @return Le moteur de recherche dans les pages annonces
     * Plus d'options incluse
     * Categories / Regions
     */
    public function recherchePrincipalAction(Request $request, $form_search = null, $form_search_region = null)
    {
        $form = $this->createForm(new RecherchePrincipalType());

        $form->handleRequest($request);

        if($request->isMethod('POST'))
        {
            $recherche = $form['recherche']->getData();
            $region    = $form['region']->getData();
            $category  = $form['category']->getData();

            if(($recherche == NULL) AND ($region == NULL))
            {
                return $this->redirect($this->generateUrl('annonce_homepage'));
            }

            $annonces =  $this->getDoctrine()->getManager()->getRepository('SiteBundle:Annonce')
                              ->rechercher($recherche, $region, $category);

            return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig', array(
                                                                                'annonces'           => $annonces,
                                                                                'form_search'        => $recherche,
                                                                                'form_search_region' => $region
            ));
        }

        return $this->render('SiteBundle:Site/Template:search_annonce.html.twig', array('form' => $form->createView(),
                                                                        'form_search'        => $form_search,
                                                                        'form_search_region' => $form_search_region
                                                                        ));
    }

}