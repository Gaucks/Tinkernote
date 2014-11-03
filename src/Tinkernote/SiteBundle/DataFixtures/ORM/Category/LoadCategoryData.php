<?php

namespace Tinkernote\SiteBundle\DataFixtures\ORM\Category;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Tinkernote\SiteBundle\Entity\Category;


class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Creation des categories Multimédia
        $informatique  		= $this->createCategory('Informatique'				, $this->getReference('parents-1'));
        $console_jeux  		= $this->createCategory('Consoles & Jeux vidéo'	, $this->getReference('parents-1'));
        $image_son  		= $this->createCategory('Image & Son'				, $this->getReference('parents-1'));
        $telephonie  		= $this->createCategory('Téléphonie'				, $this->getReference('parents-1'));

        // Creation des categories Véhicules
        $voiture  			= $this->createCategory('Voitures'					, $this->getReference('parents-2'));
        $moto  				= $this->createCategory('Moto'						, $this->getReference('parents-2'));
        $caravane  			= $this->createCategory('Caravanes'				, $this->getReference('parents-2'));
        $utilitaire  		= $this->createCategory('Utilitaires'				, $this->getReference('parents-2'));
        $equip_auto  		= $this->createCategory('Equipement Auto'			, $this->getReference('parents-2'));
        $equip_moto  		= $this->createCategory('Equipement Moto'			, $this->getReference('parents-2'));
        $nautisme  			= $this->createCategory('Nautisme'					, $this->getReference('parents-2'));
        $equip_nautisme  	= $this->createCategory('Equipement Nautisme'		, $this->getReference('parents-2'));

        // Creation des categories Immobiliers
        $locations  		= $this->createCategory('Locations'				, $this->getReference('parents-3'));
        $colocations  		= $this->createCategory('Colocations'				, $this->getReference('parents-3'));
        $vente_immo			= $this->createCategory('Ventes Immobilières'		, $this->getReference('parents-3'));
        $location_vac  		= $this->createCategory('Location de vacances'		, $this->getReference('parents-3'));
        $commerce			= $this->createCategory('Bureaux & Commerces'		, $this->getReference('parents-3'));

        // Creation des categories Immobiliers
        $meuble  			= $this->createCategory('Ameublement'				, $this->getReference('parents-4'));
        $electro  			= $this->createCategory('Electromenager'			, $this->getReference('parents-4'));
        $art_table			= $this->createCategory('Arts de la table'			, $this->getReference('parents-4'));
        $linges_maison  	= $this->createCategory('Linges de maison'			, $this->getReference('parents-4'));
        $bricolage			= $this->createCategory('Bricolage'				, $this->getReference('parents-4'));
        $jardinage			= $this->createCategory('Jardinage'				, $this->getReference('parents-4'));
        $vetements			= $this->createCategory('Vêtements'				, $this->getReference('parents-4'));
        $chaussures			= $this->createCategory('Chaussures'				, $this->getReference('parents-4'));
        $equip_bebe			= $this->createCategory('Equipement bébé'			, $this->getReference('parents-4'));
        $montres_bij		= $this->createCategory('Montres & Bijoux'			, $this->getReference('parents-4'));
        $vetements_bebe		= $this->createCategory('Vêtements bébés'			, $this->getReference('parents-4'));
        $acc_bagage			= $this->createCategory('Accessoires et Bagagerie'	, $this->getReference('parents-4'));

        // Creation des categories Loisirs
        $dvd  				= $this->createCategory('DVD / Films'				, $this->getReference('parents-5'));
        $cd  				= $this->createCategory('Cd & Musique'				, $this->getReference('parents-5'));
        $livres				= $this->createCategory('Livres'					, $this->getReference('parents-5'));
        $animaux  			= $this->createCategory('Animaux'					, $this->getReference('parents-5'));
        $commerce			= $this->createCategory('Vélos'					, $this->getReference('parents-5'));
        $sports  			= $this->createCategory('Sports & Hobbies'			, $this->getReference('parents-5'));
        $instrument  		= $this->createCategory('Instruments de musique'	, $this->getReference('parents-5'));
        $collection			= $this->createCategory('Collections'				, $this->getReference('parents-5'));
        $jouets  			= $this->createCategory('Jouets'					, $this->getReference('parents-5'));
        $vins				= $this->createCategory('Gastronomie & Vins'		, $this->getReference('parents-5'));

        // Creation des categories Immobiliers
        $materiel  			= $this->createCategory('Materiel Agricole'		, $this->getReference('parents-6'));
        $trans_manut 		= $this->createCategory('Transport & Manutention'	, $this->getReference('parents-6'));
        $btp				= $this->createCategory('BTP'						, $this->getReference('parents-6'));
        $outillage  		= $this->createCategory('Outillage'				, $this->getReference('parents-6'));
        $equip_indu			= $this->createCategory('Equipement industriel'	, $this->getReference('parents-6'));
        $resto_hotel  		= $this->createCategory('Restauration - Hotellerie', $this->getReference('parents-6'));
        $comm_marche  		= $this->createCategory('Commerces & Marchés'		, $this->getReference('parents-6'));
        $fourniture			= $this->createCategory('Fourniture de bureau'		, $this->getReference('parents-6'));
        $medical  			= $this->createCategory('Materiel Medical'			, $this->getReference('parents-6'));

        // Creation des categories Emplois et Services
        $emplois  			= $this->createCategory('Emplois'					, $this->getReference('parents-7'));
        $services  			= $this->createCategory('Services'					, $this->getReference('parents-7'));
        $billeteries		= $this->createCategory('Billeteries'				, $this->getReference('parents-7'));
        $evenement  		= $this->createCategory('Evenements'				, $this->getReference('parents-7'));
        $cours				= $this->createCategory('Cours particuliers'		, $this->getReference('parents-7'));

        // Creation des categories Divers
        $divers  			= $this->createCategory('Divers'					, $this->getReference('parents-8'));

        // Enregistrement des categories Multimédia
        $manager->persist($informatique);
        $manager->persist($console_jeux);
        $manager->persist($image_son);
        $manager->persist($telephonie);

        // Enregistrement des categories Vehicules
        $manager->persist($voiture);
        $manager->persist($moto);
        $manager->persist($caravane);
        $manager->persist($utilitaire);
        $manager->persist($equip_auto);
        $manager->persist($equip_moto);
        $manager->persist($nautisme);
        $manager->persist($equip_nautisme);

        // Enregistrement des categories Immobiliers
        $manager->persist($locations);
        $manager->persist($colocations);
        $manager->persist($vente_immo);
        $manager->persist($location_vac);
        $manager->persist($commerce);

        // Enregistrement des categories Maison
        $manager->persist($meuble);
        $manager->persist($electro);
        $manager->persist($art_table);
        $manager->persist($linges_maison);
        $manager->persist($bricolage);
        $manager->persist($jardinage);
        $manager->persist($vetements);
        $manager->persist($chaussures);
        $manager->persist($equip_bebe);
        $manager->persist($montres_bij);
        $manager->persist($vetements_bebe);
        $manager->persist($acc_bagage);

        // Enregistrement des categories Loisirs
        $manager->persist($dvd);
        $manager->persist($cd);
        $manager->persist($livres);
        $manager->persist($animaux);
        $manager->persist($commerce);
        $manager->persist($sports);
        $manager->persist($instrument);
        $manager->persist($collection);
        $manager->persist($jouets);
        $manager->persist($vins);

        // Enregistrement des Materiels Professionnel
        $manager->persist($materiel);
        $manager->persist($trans_manut);
        $manager->persist($btp);
        $manager->persist($outillage);
        $manager->persist($equip_indu);
        $manager->persist($resto_hotel);
        $manager->persist($comm_marche);
        $manager->persist($fourniture);
        $manager->persist($medical);

        // Enregistrement des categories Emplois et Service
        $manager->persist($emplois);
        $manager->persist($services);
        $manager->persist($billeteries);
        $manager->persist($evenement);
        $manager->persist($cours);

        // Enregistrement des categories Autres
        $manager->persist($divers);

        $manager->flush();

        $this->addReference('category-1', $informatique);
        $this->addReference('category-2', $materiel);
        $this->addReference('category-3', $divers);
        $this->addReference('category-4', $resto_hotel);
    }


    // Fonction de création globale
    private function createCategory($nom, $parent) {
        $category = new  Category();
        $category->setCategory($nom);
        $category->setParentcategory($parent);

        return $category;
    }

    public function getOrder()
    {
        return 13;
    }

}