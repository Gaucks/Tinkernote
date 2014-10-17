<?php

namespace Tinkernote\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $userManager = $this->container->get('fos_user.user_manager');

        // Create User

        // John Doe
        $user = $userManager->createUser();
        $user->setUsername('John');
        $user->setEmail('john@do.com');
        $user->setPlainPassword('0000');
        $user->setRegion($this->getReference('region-pa'));
        $user->setDepartement($this->getReference('departement-var'));
        $user->setVille($this->getReference('ville-vin'));
        //$user->setAvatar('no_avatar.png');
        $user->setEnabled(true);

        // Amandine G
        $user1 = $userManager->createUser();
        $user1->setUsername('AmandineG');
        $user1->setEmail('amandine_d89@yahoo.fr');
        $user1->setPlainPassword('ac150910');
        $user1->setRegion($this->getReference('region-pa'));
        $user1->setDepartement($this->getReference('departement-var'));
        $user1->setVille($this->getReference('ville-vin'));
        //$user1->setAvatar('amandineG.jpg');
        $user1->setEnabled(true);

        // Christophe Gautier
        $user2 = $userManager->createUser();
        $user2->setUsername('Kris');
        $user2->setEmail('gaucks@gmail.com');
        $user2->setPlainPassword('ac150910');
        $user2->setRegion($this->getReference('region-pa'));
        $user2->setDepartement($this->getReference('departement-var'));
        $user2->setVille($this->getReference('ville-vin'));
        $user2->setEnabled(true);

        // Guest
        $user3 = $userManager->createUser();
        $user3->setUsername('Guest');
        $user3->setEmail('guest@gmail.com');
        $user3->setPlainPassword('ac150910');
        $user3->setRegion($this->getReference('region-pa'));
        $user3->setDepartement($this->getReference('departement-var'));
        $user3->setVille($this->getReference('ville-vin'));
        //$user3->setAvatar('guest.png');
        $user3->setEnabled(true);


        // On sauvegarde en mémoires
        $manager->persist($user);
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);


        // Enregistrement
        $manager->flush();


        //Ajout des références pour les données à enregistrer
        $this->addReference('user', $user);
        $this->addReference('user-1', $user1);
        $this->addReference('user-2', $user2);
        $this->addReference('user-3', $user3);

    }

    public function getOrder()
    {
        return 4;
    }
}