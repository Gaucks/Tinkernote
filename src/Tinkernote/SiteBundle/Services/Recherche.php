<?php

namespace Tinkernote\SiteBundle\Services;

class Recherche{

    protected $em;

    /**
     * Doctrine [%doctrine%]
     */
    public function __construct($doctrine)
    {
        $this->em = $doctrine->getEntityManager();
    }

    public function findAnnonce($recherche, $region)
    {
        $annonces = $this->em->getRepository('SiteBundle:Annonce')->recherche($recherche, $region);

        return $annonces;
    }

    public function findByWord($recherche)
    {
        $annonces = $this->em->getRepository('SiteBundle:Annonce')->findByWords($recherche);

        return $annonces;
    }

}