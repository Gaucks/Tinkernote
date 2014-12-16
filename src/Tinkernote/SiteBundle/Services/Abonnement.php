<?php

namespace Tinkernote\SiteBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class Abonnement {

    protected $doctrine;
    protected $securityContext;
    protected $region_repository;

    public function __construct(EntityManager $doctrine, SecurityContext $securityContext)
    {
        $this->securityContext      = $securityContext;
        $this->doctrine             = $doctrine;
        $this->region_repository    = $this->doctrine->getRepository('SiteBundle:AbonnementRegion');
    }

    public function isRegionFollower($user, $region){

        $isFollower = $this->region_repository->findBy(array('user' => $user, 'region' => $region));

        if($isFollower){
            return true;
        }

    }

    public function getProposition($user, $region){

        $proposition = $this->region_repository->getFollower($region, $user);

        return $proposition;
    }
}