<?php

namespace Tinkernote\SiteBundle\DataFixtures\ORM\Stats;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Tinkernote\SiteBundle\Entity\Activity\ActivityType;


class LoadActivityTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $vue     = $this->createActivityType('Vue');
        $comment = $this->createActivityType('Commentaire');

        $manager->persist($vue);
        $manager->persist($comment);

        $manager->flush();
    }


    // Fonction de création globale
    private function createActivityType($nom) {
        $activityType = new  ActivityType();
        $activityType->setNom($nom);

        return $activityType;
    }

    public function getOrder()
    {
        return 14;
    }

}