<?php

namespace Tinkernote\SiteBundle\Entity\Activity;

use Doctrine\ORM\EntityRepository;

/**
 * AnnonceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentActivityRepository extends EntityRepository
{
    public function getAll($user)
    {
        $qb = $this->createQueryBuilder('a')
                    ->select('a , b, u')
                    ->leftJoin('a.annonce', 'b')
                    ->leftJoin('b.user','u')
                    ->where('u.id = :user')
                    ->setParameters(array('user' => $user));


        $response = $qb->getQuery()->getResult();
        return $response;
    }
}
