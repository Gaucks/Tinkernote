<?php

namespace Tinkernote\SiteBundle\DataFixtures\ORM\Category;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Tinkernote\SiteBundle\Entity\Parentcategory;


class LoadParentCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Creation des categorys parents
        $multimedia  		= $this->createParentsCategory('Multimédia');
        $vehicules  		= $this->createParentsCategory('Véhicules');
        $immobilier  		= $this->createParentsCategory('Immobilier');
        $maison  			= $this->createParentsCategory('Maison');
        $loisir  			= $this->createParentsCategory('Loisir');
        $emploi_services  	= $this->createParentsCategory('Emploi & services');
        $pro_equipement  	= $this->createParentsCategory('Equipement professionnel');
        $autres  			= $this->createParentsCategory('Autres');

        $manager->persist($multimedia);
        $manager->persist($vehicules);
        $manager->persist($immobilier);
        $manager->persist($maison);
        $manager->persist($loisir);
        $manager->persist($emploi_services);
        $manager->persist($pro_equipement);

        $manager->flush();

        $this->addReference('parents-1', $multimedia);
        $this->addReference('parents-2', $vehicules);
        $this->addReference('parents-3', $immobilier);
        $this->addReference('parents-4', $maison);
        $this->addReference('parents-5', $loisir);
        $this->addReference('parents-6', $emploi_services);
        $this->addReference('parents-7', $pro_equipement);
        $this->addReference('parents-8', $autres);
    }

    // Fonction de création globale
    private function createParentsCategory($nom) {
        $parents_category = new ParentCategory();
        $parents_category->setParent($nom);

        return $parents_category;
    }

    public function getOrder()
    {
        return 5;
    }

}