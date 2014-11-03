<?php

namespace Tinkernote\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PictureController extends Controller
{
    public function pluploadAction()
    {
        $response = $this->redirect($this->generateUrl('site_homepage'));

        return $response;
    }
}
