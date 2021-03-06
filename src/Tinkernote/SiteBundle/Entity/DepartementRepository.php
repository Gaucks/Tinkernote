<?php

namespace Tinkernote\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DepartementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DepartementRepository extends EntityRepository
{
    public function Departement($region)
    {
        $qb = $this->createQueryBuilder('d')
            ->where('d.region = :region')
            ->setParameter('region', $region);

        return $qb->getQuery()
            ->getArrayResult();
    }
}