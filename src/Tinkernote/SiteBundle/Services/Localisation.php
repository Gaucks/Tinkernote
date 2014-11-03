<?php

namespace Tinkernote\SiteBundle\Services;

class Localisation
{
    /**
     * Service gérant tout ce qui concerne l'affichage
     * des régions
     * des departements
     * des villes
     */
    protected $em;

    /**
     * Doctrine [%doctrine%]
     */
    public function __construct($doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    /**
     * Renvoi la liste des régions
     */
    public function getAllRegions()
    {
        $regions = $this->em->getRepository('SiteBundle:Region')->findBy(array(), array('nom' => 'asc'));

        if(!$regions){
            return false;
        }
        else{
            return $regions;
        }
    }

    /**
     * Renvoi la liste des villes
     */
    public function getAllVilles()
    {
        $villes = $this->em->getRepository('SiteBundle:Ville')->findBy(array(), array('nom' => 'asc'));

        if(!$villes){
            return false;
        }
        else{
            return $villes;
        }
    }

    /**
     * Renvoi la liste des departements
     */
    public function getAllDepartements()
    {
        $departements = $this->em->getRepository('SiteBundle:Departement')->findBy(array(), array('nom' => 'asc'));

        if(!$departements){
            return false;
        }
        else{
            return $departements;
        }
    }
}