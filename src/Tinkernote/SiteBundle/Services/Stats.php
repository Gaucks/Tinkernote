<?php

namespace Tinkernote\SiteBundle\Services;


use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\Model\UserInterface;


class Stats{

    protected $em;
    protected $securityContext;

    public function __construct($em, SecurityContext $securityContext)
    {
        $this->em              = $em->getManager();
        $this->securityContext = $securityContext;

        $this->user = $this->securityContext->getToken()->getUser();
        if (!is_object($this->user) || !$this->user instanceof UserInterface) {
            $this->user = null;
        }

    }

    public function countOnlineUsers()
    {
        $response = $this->em->getRepository('UserBundle:User')->countOnlineUsers();
        return $response;
    }

    public function allstats($user)
    {

        $total_annonces       = $this->CountTotalAnnonces($user);
        $total_activeAnnonces = $this->CountTotalActiveAnnonce($user);
        $pflCompletion        = $this->tauxCompletion($user);
        $userLevel            = $this->userLevel($total_annonces, $pflCompletion);
        $lastAnnonce          = $this->em->getRepository('SiteBundle:Annonce')->findOneBy(  array('id' => $user),
                                                                                            array('date' => 'DESC'),
                                                                                            array('limit' => 1));
        // Les stats de la journée en cours
        $dayliAnnonce         = $this->countDayliAnnonce();
        $newsInRegion         = $this->countDayliAnnonceInMyRegion();

        $stats                = array(  'totalAnnonces'        => $total_annonces,
                                        'total_activeAnnonces' => $total_activeAnnonces,
                                        'lastAnnonce'          => $lastAnnonce,
                                        'pflcompletion'        => $pflCompletion,
                                        'userLevel'            => $userLevel,
                                        'newInRegion'          => $newsInRegion,
                                        'dayliAnnonce'         => $dayliAnnonce
        );
        return $stats;
    }

    public function isFriends($userChecked)
    {
        $friends = $this->em->getRepository('SiteBundle:Activity\AbonnementActivity')->findBy(array('followed' => $userChecked, 'follower' => $this->user));

        if(!$friends)
        {
            return false;
        }

        return true;
    }

    private function countTotalAnnonces($user)
    {
        $response  =  $this->em->getRepository('SiteBundle:Annonce')->countTotalAnnonces($user);
        return  $response;
    }

    private function CountTotalActiveAnnonce($user){
        $response  =  $this->em->getRepository('SiteBundle:Annonce')->CountTotalActiveAnnonce($user);
        return  $response;
    }

    private function tauxCompletion($user)
    {
        $rep  =  $this->em->getRepository('UserBundle:User');

        $qb  =   $rep->createQueryBuilder('a')
                     ->leftJoin('a.avatar', 'b')
                     ->select('a.age, a.phone, a.name, a.username, a.firstname, b.id')
                     ->Where('a.id = :user')
                     ->setParameter('user', $user)
                     ->getQuery();

        $result = $qb->getResult();

        $count = 20;
        //var_dump($result[0]);
        if($result[0] != null) // Si il y a un résultat on compte le nombre de champs qui n'est pas null et on incrémente de 1
        {
            if($result[0]['age'] != null)
            {
                $count+=10;
            }
            if($result[0]['phone'] != null)
            {
                $count+=10;
            }
            if($result[0]['name'] != null)
            {
                $count+=10;
            }
            if($result[0]['firstname'] != null)
            {
                $count+=10;
            }
            if($result[0]['name'] != null)
            {
                $count+=10;
            }
            if($result[0]['id'] != null) // L'avatar
            {
                $count+=10;
            }
        }

        return $count;
    }

    private function userLevel($total_annonces, $pflCompletion)
    {
        if($total_annonces < 5)
        {
            if($pflCompletion >= 40)
            {
                $level = 'Initié';
            }

            if($pflCompletion <= 30)
            {
                $level = 'Débutant';
            }

            else
            {
                $level = 'Débutant';
            }

            return $level;
        }

        if($total_annonces >= 5)
        {
            $level = 'Habitué des lieux';
        }

        else{
            $level = 'Débutant';
        }

        return $level;
    }

    private function countDayliAnnonce()
    {
        $response  =  $this->em->getRepository('SiteBundle:Annonce')->CountDayliAnnonce();
        return  $response;
    }

    private function countDayliAnnonceInMyRegion()
    {
        $response  =  $this->em->getRepository('SiteBundle:Annonce')->CountDayliAnnonce($this->user);
        return  $response;
    }


}