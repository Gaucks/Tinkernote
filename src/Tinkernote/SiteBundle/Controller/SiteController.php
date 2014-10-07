<?php

namespace Tinkernote\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteBundle:Site:Accueil/accueil.html.twig');
    }

    public function soonAction()
    {
        return $this->render('SiteBundle:Site:soon/soon.html.twig');

    }

}
