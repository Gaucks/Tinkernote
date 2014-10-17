<?php 
// src/Tinkernote/SiteBundle/DataFixtures/ORM/LoadDepartementsData.php


namespace Tinkernote\SiteBundle\DataFixtures\ORM\Ville;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Tinkernote\SiteBundle\Entity\Departement;


class LoadDepartementData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    
    public function load(ObjectManager $manager)
	{	
	
		// Création des départements PACA
		$bouches_du_rhone 	    = $this->createDepartement('Bouches-du-Rhone',          13 , $this->getReference('region-pa') );
		$var 				    = $this->createDepartement('Var',			            83 , $this->getReference('region-pa') );
		$vaucluse 			    = $this->createDepartement('Vaucluse', 		            84 , $this->getReference('region-pa') );
		$haute_alpes 		    = $this->createDepartement('Hautes-Alpes', 	            05 , $this->getReference('region-pa') );
		$alpes_maritimes 	    = $this->createDepartement('Alpes-Maritime',            06 , $this->getReference('region-pa') );
        $alpes_de_haute_pce 	= $this->createDepartement('Alpes-de-Haute-Provence',   04 , $this->getReference('region-pa') );

        // Création des départements Ile de france
        $paris           	    = $this->createDepartement('Paris',                     75 , $this->getReference('region-fr') );
        $seine_et_marne 	    = $this->createDepartement('Seine-et-Marne',			77 , $this->getReference('region-fr') );
        $yvelines 			    = $this->createDepartement('Yvelines', 		            78 , $this->getReference('region-fr') );
        $essonne 		        = $this->createDepartement('Essonne', 	                92 , $this->getReference('region-fr') );
        $haut_de_seine 	        = $this->createDepartement('Hauts-de-Seine',            92 , $this->getReference('region-fr') );
        $seine_st_denis 	    = $this->createDepartement('Seine-Saint-Denis', 		93 , $this->getReference('region-fr') );
        $val_de_marne 		    = $this->createDepartement('Val-de-Marne', 	            94 , $this->getReference('region-fr') );
        $val_oise 	            = $this->createDepartement('Val-d\'Oise',               95 , $this->getReference('region-fr') );
		
		// Enregistrement dans doctrine
        $departements = array($bouches_du_rhone, $var, $vaucluse, $haute_alpes, $alpes_maritimes, $alpes_de_haute_pce, $paris, $seine_et_marne, $yvelines, $essonne,
                              $haut_de_seine, $seine_st_denis,$val_de_marne, $val_oise);

        foreach ($departements as $row)
        {
            $manager->persist($row);
        }

		// Enregistrement en BDD
		$manager->flush();

		// Ajout des références pour transmettre aux villes
		$this->addReference('departement-bdr', $bouches_du_rhone);
		$this->addReference('departement-var', $var);
		$this->addReference('departement-vau', $vaucluse);
		$this->addReference('departement-hlp', $haute_alpes);
		$this->addReference('departement-alm', $alpes_maritimes);
        $this->addReference('departement-fr' , $paris);
	}
	
	// Fonction de création golbale
	private function createDepartement($nom, $num, $region_id ) {
		$departements = new Departement();
		$departements->setNom($nom);
		$departements->setNumero($num);
		$departements->setRegion($region_id);
 
		return $departements;
	}
    
    // Fonction de mise en ordre
    public function getOrder()
	{
		return 2;
	}
    
}