<?php

namespace Tinkernote\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AnnonceController extends Controller {

    public function indexAction() {
        return $this->render('SiteBundle:Annonce/Accueil:annonce_accueil.html.twig');
    }

    public function showAction(){
        return $this->render('SiteBundle:Annonce/Show:show.html.twig');
    }

    public function addAction(){
        return $this->render('SiteBundle:Annonce/Add:add.html.twig');
    }

    public function step2Action(){
        return $this->render('SiteBundle:Annonce/Add:step2.html.twig');
    }

    public function step3Action(){
        return $this->render('SiteBundle:Annonce/Add:step3.html.twig');
    }
}