<?php

namespace Tinkernote\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function countOnlineUsers()
    {
        $date5mins = new \DateTime('5 minutes ago');

        $builder = $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.last_activity > :date5mins')
            ->setParameter('date5mins', $date5mins);

        $count = $builder->getQuery()->getSingleScalarResult();

        return $count;

    }

    public function getAllUnfollowed($user, $liste){

        $qb = $this->createQueryBuilder('u')
                    ->where('u.id NOT IN (:liste)')
                    ->andWhere('u.id != :user')
                    ->setParameters(array('liste' => $liste, 'user' => $user))
                    ->getQuery();

        $response = $qb->getResult();

        return  $response;

    }
}