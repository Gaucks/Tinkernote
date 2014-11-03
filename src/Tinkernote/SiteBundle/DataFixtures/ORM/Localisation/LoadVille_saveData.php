<?php 
//// src/Tinkernote/SiteBundle/DataFixtures/ORM/LoadVilleData.php
//
//
//namespace Tinkernote\SiteBundle\DataFixtures\ORM\Ville;
//
//use Doctrine\Common\DataFixtures\AbstractFixture;
//use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
//use Doctrine\Common\Persistence\ObjectManager;
//
//use Tinkernote\SiteBundle\Entity\Ville;
//
//
//class LoadVilleData extends AbstractFixture implements OrderedFixtureInterface
//{
//    /**
//     * {@inheritDoc}
//     */
//    public function load(ObjectManager $manager)
//    {
//        $postal = '13100';
//        // Bouches du rhone
//        $marseille  	= $this->createVille('Marseille'			, $this->getReference('departement-bdr'), '13000');
//        $aix_en_pce  	= $this->createVille('Aix en Provence'		, $this->getReference('departement-bdr'), '13100');
//        $eguilles  		= $this->createVille('Eguilles'				, $this->getReference('departement-bdr'), $postal);
//        $aubagne  		= $this->createVille('Aubagne'				, $this->getReference('departement-bdr'), $postal);
//        $trets  		= $this->createVille('Trets'				, $this->getReference('departement-bdr'), $postal);
//        $gardanne  		= $this->createVille('Gardanne'				, $this->getReference('departement-bdr'), $postal);
//        $septemes  		= $this->createVille('Septemes les vallons'	, $this->getReference('departement-bdr'), '13240');
//
//
//        // Var
//        $st_julien 		= $this->createVille('St Julien'			, $this->getReference('departement-var'), '83560');
//        $ginasservis 	= $this->createVille('Ginasservis'			, $this->getReference('departement-var'), '83560');
//        $la_verdiere 	= $this->createVille('La verdiere'			, $this->getReference('departement-var'), '83560');
//        $vinon 			= $this->createVille('Vinon sur Verdon'		, $this->getReference('departement-var'), '83560');
//
//        // Hautes Alpes
//        $manosque 		= $this->createVille('Manosque'				, $this->getReference('departement-hlp'), '04100');
//        $volx 			= $this->createVille('Volx'					, $this->getReference('departement-hlp'), '04130');
//        $st_tulle 		= $this->createVille('Sainte Tulle'			, $this->getReference('departement-hlp'), '04220');
//
//        // Alpes Maritimes
//        $nice 		    = $this->createVille('Nice'			        , $this->getReference('departement-alm'), '06000');
//
//        // Ile de france
//        $paris          = $this->createVille('Paris'			     , $this->getReference('departement-fr'), '75000');
//
//        // Persist des objets
//        $manager->persist($marseille);
//        $manager->persist($manosque);
//        $manager->persist($aix_en_pce);
//        $manager->persist($eguilles);
//        $manager->persist($aubagne);
//        $manager->persist($trets);
//        $manager->persist($gardanne);
//        $manager->persist($vinon);
//        $manager->persist($st_julien);
//        $manager->persist($la_verdiere);
//        $manager->persist($ginasservis);
//        $manager->persist($st_tulle);
//        $manager->persist($volx);
//        $manager->persist($septemes);
//        $manager->persist($nice);
//        $manager->persist($paris);
//
//
//        $manager->flush();
//
//        // Ajout des références pour transmettre aux villes
//        $this->addReference('ville-vin', $vinon);
//        $this->addReference('ville-mar', $marseille);
//        $this->addReference('ville-nic', $nice);
//        $this->addReference('ville-tul', $st_tulle);
//        $this->addReference('ville-psg', $paris);
//    }
//
//    // Fonction de création golbale
//    private function createVille($nom, $num, $postal ) {
//        $ville = new Ville();
//        $ville->setNom($nom);
//        $ville->setDepartement($num);
//        $ville->setPostal($postal);
//
//        return $ville;
//    }
//
//    public function getOrder()
//    {
//        return 3;
//    }
//
//}