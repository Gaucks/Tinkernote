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
        $paris           	    = $this->createDepartement('Paris',                     75 , $this->getReference('region-fr') );
        $seine_et_marne 	    = $this->createDepartement('Seine-et-Marne',			77 , $this->getReference('region-fr') );
        $yvelines 			    = $this->createDepartement('Yvelines', 		            78 , $this->getReference('region-fr') );
        $essonne 		        = $this->createDepartement('Essonne', 	                91 , $this->getReference('region-fr') );
        $haut_de_seine 	        = $this->createDepartement('Hauts-de-seine',            92 , $this->getReference('region-fr') );
        $seine_st_denis 	    = $this->createDepartement('Seine-saint-denis', 		93 , $this->getReference('region-fr') );
        $val_de_marne 		    = $this->createDepartement('Val-de-marne', 	            94 , $this->getReference('region-fr') );
        $val_oise 	            = $this->createDepartement('Val-d\'oise',               95 , $this->getReference('region-fr') );
        $ain 	                = $this->createDepartement('Ain',                       01 , $this->getReference('region-ra') );
        $aisne                  = $this->createDepartement('Aisne',                     02 , $this->getReference('region-pi') );
        $allier                 = $this->createDepartement('Allier',                    03 , $this->getReference('region-av') );
        $drome                  = $this->createDepartement('Drome',                     26 , $this->getReference('region-ra') );
        $ardeche                = $this->createDepartement('Ardeche',                   07 , $this->getReference('region-ra') );
        $lozere                 = $this->createDepartement('Lozère',                    48 , $this->getReference('region-lg') );
        $ardennes               = $this->createDepartement('Ardennes',                  00 , $this->getReference('region-ch') );
        $ariege                 = $this->createDepartement('Ariege',                    00 , $this->getReference('region-mp') );
        $aude                   = $this->createDepartement('Aude',                      11 , $this->getReference('region-lg') );
        $aube                   = $this->createDepartement('Aube',                      10 , $this->getReference('region-ch') );
        $aveyron                = $this->createDepartement('Aveyron',                   12 , $this->getReference('region-mp') );
        $calvados               = $this->createDepartement('Calvados',                  14 , $this->getReference('region-bn') );
        $cantal                 = $this->createDepartement('Cantal',                    15 , $this->getReference('region-av') );
        $charente               = $this->createDepartement('Charente',                  16 , $this->getReference('region-pc') );
        $charente_m             = $this->createDepartement('Charente maritime',         17 , $this->getReference('region-pc') );
        $cher                   = $this->createDepartement('Cher',                      18 , $this->getReference('region-ce') );
        $correze                = $this->createDepartement('Correze',                   19 , $this->getReference('region-li') );
        $corse                  = $this->createDepartement('Corse',                     01 , $this->getReference('region-fr') );
        $cotedor                = $this->createDepartement('Cote d\'or',                01 , $this->getReference('region-bo') );
        $cotedarmor             = $this->createDepartement('Cote d\'armore',            22 , $this->getReference('region-br') );
        $creuse                 = $this->createDepartement('Creuse',                    23 , $this->getReference('region-li') );
        $dordogne               = $this->createDepartement('Dordogne',                  24 , $this->getReference('region-aq') );
        $doubs                  = $this->createDepartement('Doubs',                     25 , $this->getReference('region-fc') );
        $finistere              = $this->createDepartement('Finistere',                 29 , $this->getReference('region-br') );
        $eureloire              = $this->createDepartement('Eure et loire',             28 , $this->getReference('region-ce') );
        $eure                   = $this->createDepartement('Eure',                      27 , $this->getReference('region-hn') );
        $gard                   = $this->createDepartement('Gard',                      30 , $this->getReference('region-lg') );
        $garonne                = $this->createDepartement('Garonne',                   31 , $this->getReference('region-fr') );
        $gers                   = $this->createDepartement('Gers',                      32 , $this->getReference('region-mp') );
        $gironde                = $this->createDepartement('Gironde',                   33 , $this->getReference('region-aq') );
        $heyrault               = $this->createDepartement('Hérault',                   34 , $this->getReference('region-lg') );
        $vilaine                = $this->createDepartement('Ille et vilaine',           35 , $this->getReference('region-br') );
        $indre                  = $this->createDepartement('Indre',                     36 , $this->getReference('region-ce') );
        $indreloire             = $this->createDepartement('Indre et loire',            37 , $this->getReference('region-ce') );
        $isere                  = $this->createDepartement('Isere',                     38 , $this->getReference('region-ra') );
        $jura                   = $this->createDepartement('Jura',                      39 , $this->getReference('region-fc') );
        $landes                 = $this->createDepartement('Landes',                    40 , $this->getReference('region-aq') );
        $loirecher              = $this->createDepartement('Loir et cher',              41 , $this->getReference('region-ce') );
        $loire                  = $this->createDepartement('Loire',                     42 , $this->getReference('region-ra') );
        $hauteloire             = $this->createDepartement('Haute loire',               43 , $this->getReference('region-av') );
        $loireatl               = $this->createDepartement('Loire atlantique',          44 , $this->getReference('region-pl') );
        $loiret                 = $this->createDepartement('Loiret',                    45 , $this->getReference('region-ce') );
        $lot                    = $this->createDepartement('Lot',                       46 , $this->getReference('region-mp') );
        $lotgaronne             = $this->createDepartement('Lot et garonne',            47 , $this->getReference('region-aq') );
        $maineloire             = $this->createDepartement('Maine et loire',            49 , $this->getReference('region-pl') );
        $manche                 = $this->createDepartement('Manche',                    50 , $this->getReference('region-bn') );
        $marne                  = $this->createDepartement('Marne',                     51 , $this->getReference('region-ch') );
        $hautemarne             = $this->createDepartement('Haute marne',               52 , $this->getReference('region-ch') );
        $mayenne                = $this->createDepartement('Mayenne',                   53 , $this->getReference('region-pl') );
        $meurthe                = $this->createDepartement('Meurthe',                   54 , $this->getReference('region-lo') );
        $meuse                  = $this->createDepartement('Meuse',                     55 , $this->getReference('region-lo') );
        $morbihan               = $this->createDepartement('Morbihan',                  56 , $this->getReference('region-br') );
        $moselle                = $this->createDepartement('Moselle',                   57 , $this->getReference('region-lo') );
        $nievre                 = $this->createDepartement('Nievre',                    58 , $this->getReference('region-bo') );
        $nord                   = $this->createDepartement('Nord',                      59 , $this->getReference('region-np') );
        $nordpasdecalais        = $this->createDepartement('Nord pas de calais',        62 , $this->getReference('region-np') );
        $pasdeclais             = $this->createDepartement('Pas de calais',             01 , $this->getReference('region-fr') );
        $oise                   = $this->createDepartement('Oise',                      60 , $this->getReference('region-pi') );
        $orne                   = $this->createDepartement('Orne',                      61 , $this->getReference('region-bn') );
        $puydedome              = $this->createDepartement('Puy de dome',               63 , $this->getReference('region-av') );
        $pyreneesatl            = $this->createDepartement('Pyrenées atlantiques',      64 , $this->getReference('region-aq') );
        $hautepyrenees          = $this->createDepartement('Haute pyrenées ',           65 , $this->getReference('region-mp') );
        $pyreneesori            = $this->createDepartement('Pyrenées orientales',       66 , $this->getReference('region-lg') );
        $basrhin                = $this->createDepartement('Bas rhin',                  67 , $this->getReference('region-al') );
        $hautrhin               = $this->createDepartement('Haut rhin',                 68 , $this->getReference('region-al') );
        $rhone                  = $this->createDepartement('Rhone',                     69 , $this->getReference('region-ra') );
        $hautesaone             = $this->createDepartement('Haute-Saone',               70 , $this->getReference('region-fc') );
        $saonloire              = $this->createDepartement('Saone et loire',            71 , $this->getReference('region-bo') );
        $sarthe                 = $this->createDepartement('Sarthe',                    72 , $this->getReference('region-pl') );
        $savoie                 = $this->createDepartement('Savoie',                    73 , $this->getReference('region-ra') );
        $hautesavoie            = $this->createDepartement('Haute savoie',              74 , $this->getReference('region-ra') );
        $seinemaritime          = $this->createDepartement('Seine maritime',            76 , $this->getReference('region-hn') );
        $deuxsevre              = $this->createDepartement('Deux sevres',               79 , $this->getReference('region-pc') );
        $somme                  = $this->createDepartement('Somme',                     80 , $this->getReference('region-pi') );
        $tarn                   = $this->createDepartement('Tarn',                      81 , $this->getReference('region-mp') );
        $tarngaronne            = $this->createDepartement('Tarn et garonne',           82 , $this->getReference('region-mp') );
        $vendee                 = $this->createDepartement('Vendee',                    85 , $this->getReference('region-pl') );
        $vienne                 = $this->createDepartement('Vienne',                    86 , $this->getReference('region-pc') );
        $vosges                 = $this->createDepartement('Vosges',                    88 , $this->getReference('region-lo') );
        $yonne                  = $this->createDepartement('Yonne',                     89 , $this->getReference('region-bo') );
        $belfort                = $this->createDepartement('Territoire de belfort',     90 , $this->getReference('region-fc') );
        $valdoise               = $this->createDepartement('Val d\'oise',               95 , $this->getReference('region-fr') );
        $guadeloupe             = $this->createDepartement('Guadeloupe',                01 , $this->getReference('region-fr') );
        $reunion                = $this->createDepartement('Reunion',                   01 , $this->getReference('region-fr') );
        $martinique             = $this->createDepartement('Martinique',                01 , $this->getReference('region-fr') );
        $guyanne                = $this->createDepartement('Guyanne',                   01 , $this->getReference('region-fr') );
        $stpierre               = $this->createDepartement('St pierre et miquelon',     01 , $this->getReference('region-fr') );
        $mayotte                = $this->createDepartement('Mayotte',                   01 , $this->getReference('region-fr') );
        $wallis                 = $this->createDepartement('Wallis et futuna',          01 , $this->getReference('region-fr') );
        $polynesie              = $this->createDepartement('Polynesie francaise',       01 , $this->getReference('region-fr') );
        $caledonie              = $this->createDepartement('Nouvelle caledonie',        01 , $this->getReference('region-fr') );
        $monaco                 = $this->createDepartement('Monaco',                    99 , $this->getReference('region-mo') );
        $hautevienne            = $this->createDepartement('Haute vienne',              87 , $this->getReference('region-li') );
        $hautecorse             = $this->createDepartement('Haute Corse',               '2B', $this->getReference('region-co') );
        $corsesud               = $this->createDepartement('Corse du sud',              '2A', $this->getReference('region-co') );




        // Enregistrement dans doctrine
        $departements = array($corsesud,$hautecorse,$bouches_du_rhone, $var, $vaucluse, $haute_alpes, $alpes_maritimes, $alpes_de_haute_pce, $paris, $seine_et_marne, $yvelines, $essonne,
                              $haut_de_seine, $seine_st_denis,$val_de_marne, $val_oise,$ain,$aisne,$allier,$drome,$ardeche,$lozere,$ardennes, $ariege, $aude,$aveyron,$calvados,
                              $cantal,$charente,$charente_m ,$cher,$correze,$corse,$cotedor ,$cotedarmor,$creuse,$dordogne,$doubs,$finistere,$eureloire,$gard,$garonne,$gers,$gironde,$heyrault,
                              $vilaine,$indre,$indreloire,$isere,$jura,$marne,$martinique,$guyanne,$monaco,$caledonie,$polynesie,$stpierre,$mayenne,$mayotte,$wallis,$guadeloupe,
                              $reunion,$belfort,$vosges,$yonne,$valdoise,$somme,$tarn,$tarngaronne,$vienne,$vendee,$deuxsevre,$savoie,$hautepyrenees,$hautemarne,$saonloire,
                              $seinemaritime,$basrhin,$hautrhin,$rhone,$sarthe,$hautesavoie,$hautesaone,$oise,$orne,$nievre,$pasdeclais,$nordpasdecalais,$nord,$meurthe,$moselle,
                              $puydedome,$pyreneesatl,$pyreneesori,$lot,$aube,$lotgaronne,$meuse,$morbihan,$maineloire,$manche,$loirecher,$landes,$loire,$loiret,$hauteloire,$loireatl,$hautevienne
        );

        foreach ($departements as $row)
        {
            $manager->persist($row);
        }

		// Enregistrement en BDD
		$manager->flush();

		// Ajout des références pour transmettre aux villes
        $this->addReference('departement-corsesud',     $corsesud);
        $this->addReference('departement-hautecorse',   $hautecorse);
        $this->addReference('departement-fr',           $bouches_du_rhone);
		$this->addReference('departement-bdr',          $bouches_du_rhone);
		$this->addReference('departement-var',          $var);
        $this->addReference('departement-ain',          $ain);
		$this->addReference('departement-vau',          $vaucluse);
		$this->addReference('departement-hlp',          $haute_alpes);
		$this->addReference('departement-alm',          $alpes_maritimes);
        $this->addReference('departement-paris',        $paris);
        $this->addReference('departement-asn',          $aisne);
        $this->addReference('departement-allier',       $allier);
        $this->addReference('departement-ahp',          $alpes_de_haute_pce);
        $this->addReference('departement-dro',          $drome);
        $this->addReference('departement-ard',          $ardeche);
        $this->addReference('departement-loz',          $lozere);
        $this->addReference('departement-ardenne',      $ardennes);
        $this->addReference('departement-ariege',       $ariege);
        $this->addReference('departement-aude',         $aude);
        $this->addReference('departement-aube',         $aube);
        $this->addReference('departement-aveyron',      $aveyron);
        $this->addReference('departement-calvados',     $calvados);
        $this->addReference('departement-cantal',       $cantal);
        $this->addReference('departement-charente',     $charente);
        $this->addReference('departement-charente-m',   $charente_m);
        $this->addReference('departement-cher',         $cher);
        $this->addReference('departement-correze',      $correze);
        $this->addReference('departement-corse',        $corse);
        $this->addReference('departement-cotedor',      $cotedor);
        $this->addReference('departement-cotedarmor',   $cotedarmor);
        $this->addReference('departement-creuse',       $creuse);
        $this->addReference('departement-dordog',       $dordogne);
        $this->addReference('departement-vilaine',      $vilaine);
        $this->addReference('departement-doubs',        $doubs);
        $this->addReference('departement-drome',        $drome);
        $this->addReference('departement-essonne',      $essonne);
        $this->addReference('departement-finistere',    $finistere);
        $this->addReference('departement-eureloire',    $eureloire);
        $this->addReference('departement-gard',         $gard);
        $this->addReference('departement-gers',         $gers);
        $this->addReference('departement-garonne',      $garonne);
        $this->addReference('departement-heyrault',     $heyrault);
        $this->addReference('departement-loire',        $loire);
        $this->addReference('departement-pyreneesorientales',  $pyreneesori);
        $this->addReference('departement-indre',        $indre);
        $this->addReference('departement-indreloire',   $indreloire);
        $this->addReference('departement-isere',        $isere);
        $this->addReference('departement-jura',         $jura);
        $this->addReference('departement-marne',        $marne);
        $this->addReference('departement-martinique',   $martinique);
        $this->addReference('departement-guyanne',      $guyanne);
        $this->addReference('departement-guadeloupe',   $guadeloupe);
        $this->addReference('departement-reunion',      $reunion);
        $this->addReference('departement-monaco',       $monaco);
        $this->addReference('departement-caledonie',    $caledonie);
        $this->addReference('departement-polynesie',    $polynesie);
        $this->addReference('departement-stpierre',     $stpierre);
        $this->addReference('departement-mayenne',      $mayenne);
        $this->addReference('departement-mayotte',      $mayotte);
        $this->addReference('departement-wallis',       $wallis);
        $this->addReference('departement-belfort',      $belfort);
        $this->addReference('departement-vosges',       $vosges);
        $this->addReference('departement-yonne',        $yonne);
        $this->addReference('departement-valdoise',     $valdoise);
        $this->addReference('departement-somme',        $somme);
        $this->addReference('departement-tarn',         $tarn);
        $this->addReference('departement-tarngaronne',  $tarngaronne);
        $this->addReference('departement-vienne',       $vienne);
        $this->addReference('departement-deuxsevre',    $deuxsevre);
        $this->addReference('departement-savoie',       $savoie);
        $this->addReference('departement-hautepyrenees',$hautepyrenees);
        $this->addReference('departement-hautemarne',   $hautemarne);
        $this->addReference('departement-saonloire',    $saonloire);
        $this->addReference('departement-basrhin',      $basrhin);
        $this->addReference('departement-hautrhin',     $hautrhin);
        $this->addReference('departement-rhone',        $rhone);
        $this->addReference('departement-herault',      $heyrault);
        $this->addReference('departement-sarthe',       $sarthe);
        $this->addReference('departement-hautesavoie',  $hautesavoie);
        $this->addReference('departement-hautesaone',   $hautesaone);
        $this->addReference('departement-oise',         $oise);
        $this->addReference('departement-valoise',      $valdoise);
        $this->addReference('departement-orne',         $orne);
        $this->addReference('departement-nievre',       $nievre);
        $this->addReference('departement-pasdecalais',  $pasdeclais);
        $this->addReference('departement-nordpasdecalais',$nordpasdecalais);
        $this->addReference('departement-puydedome',    $puydedome);
        $this->addReference('departement-seinemaritime',$seinemaritime);
        $this->addReference('departement-gironde',      $gironde);
        $this->addReference('departement-landes',       $landes);
        $this->addReference('departement-loirecher',    $loirecher);
        $this->addReference('departement-hauteloire',   $hauteloire);
        $this->addReference('departement-loireatl',     $loireatl);
        $this->addReference('departement-maineloire',   $maineloire);
        $this->addReference('departement-loiret',       $loiret);
        $this->addReference('departement-lot',          $lot);
        $this->addReference('departement-lotgaronne',   $lotgaronne);
        $this->addReference('departement-lozere',       $lozere);
        $this->addReference('departement-manche',       $manche);
        $this->addReference('departement-meurthemoselle',$meurthe);
        $this->addReference('departement-meuse',        $meuse);
        $this->addReference('departement-morbihan',     $morbihan);
        $this->addReference('departement-moselle',      $moselle);
        $this->addReference('departement-nord',         $nord);
        $this->addReference('departement-pyreneesatl',  $pyreneesatl);
        $this->addReference('departement-hautespyrenees',$hautepyrenees);
        $this->addReference('departement-alpesmaritimes',$alpes_maritimes);
        $this->addReference('departement-saoneloire',   $saonloire);
        $this->addReference('departement-seinemarne',   $seine_et_marne);
        $this->addReference('departement-yvelines',     $yvelines);
        $this->addReference('departement-deuxsevres',   $deuxsevre);
        $this->addReference('departement-vaucluse',     $vaucluse);
        $this->addReference('departement-vendee',       $vendee);
        $this->addReference('departement-hautevienne',  $hautevienne);
        $this->addReference('departement-hautsdeseine', $haut_de_seine);
        $this->addReference('departement-seinestdenis', $seine_st_denis);
        $this->addReference('departement-valdemarne',   $val_de_marne);
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