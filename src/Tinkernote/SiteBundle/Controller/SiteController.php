<?php

namespace Tinkernote\SiteBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tinkernote\SiteBundle\Form\RechercheType;


class SiteController extends Controller
{
    public function indexAction()
    {

        $user = $this->getUser();
        if (is_object($user) || $user instanceof UserInterface) {
            $response = $this->redirect($this->generateUrl('bloc_homepage'));
            return $response;
        }
        /**
         * Renvoi la liste des régions via le service regionSelecteur
         * Utiliser pour le selecteurs et pour le footer
         */
        $localisation       = $this->get('localisation.service');
        $regions            = $localisation->getAllRegions();

        $form = $this->createForm(new RechercheType());

        return $this->render('SiteBundle:Site:Accueil/accueil.html.twig', array('regions' => $regions, 'form' => $form->createView()));
    }

    public function soonAction()
    {
        return $this->render('SiteBundle:Site:soon/soon.html.twig');

    }

    public function rempliAction(Request $request)
    {
        if($request->isXmlHttpRequest()) // pour vérifier la présence d'une requete Ajax
        {
            $id = $request->request->get('id');
            $selecteur = $request->request->get('select');

            if ($id != null)
            {
                $data = $this->getDoctrine()->getManager()
                             ->getRepository('SiteBundle:'.$selecteur)
                             ->$selecteur($id);

                return new JsonResponse($data);
            }

        }

        return new Response("Nonnn y'a une erreur dans le code");
    }

    public function rempliCategoryAction(Request $request)
    {
        if($request->isXmlHttpRequest()) // pour vérifier la présence d'une requete Ajax
        {
            $id = $request->request->get('id');
            $selecteur = $request->request->get('select');

            if ($id != null)
            {
                $data = $this->getDoctrine()->getManager()
                    ->getRepository('SiteBundle:Category')
                    ->$selecteur($id);

                return new JsonResponse($data);
            }
            return new Response('Erreur');
        }

        return new Response('Erreur');
    }

    public function rempliPostalAction(Request $request , $cp){

        if($request->isXmlHttpRequest()) // pour vérifier la présence d'une requete Ajax
        {
            $em = $this->getDoctrine()->getManager();
            $villeCodePostal = $em->getRepository('SiteBundle:Ville')->findByCodePostal($cp);

            if ($villeCodePostal) {
                $villes = array();
                foreach ($villeCodePostal as $ville) {
                    $villes[] = array('nom' => $ville->getNom(),'id' => $ville->getId(), 'postal' => $ville->getPostal());
                }
            }
            else{
                $villes[] = array('nom' => 'Aucune ville ne correspond à ce code...', 'id' => '') ;
            }
                $response = new JsonResponse();
                return $response->setData(array('villepostal' => $villes));
        }
        else{
            throw new \Exception('Erreur dans le code....');
        }
    }

}
