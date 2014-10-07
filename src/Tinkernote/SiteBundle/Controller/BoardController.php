<?php

namespace Tinkernote\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BoardController extends Controller {

    public function indexAction()
    {
        return $this->render('SiteBundle:Board:board.html.twig');
    }

} 