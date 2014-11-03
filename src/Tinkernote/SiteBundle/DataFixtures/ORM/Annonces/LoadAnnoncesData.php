<?php

namespace Tinkernote\SiteBundle\DataFixtures\ORM\Annonces;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Tinkernote\SiteBundle\Entity\Annonce;

class LoadAnnoncesData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $lorem = "Lorem ipsum dolor sit amet occaecat cupidatat non proident,
                 sunt in culpa qui officia deserunt mollit anim id est laborum.";

        $lorem1 = "DE DISPO Calandre VW NEUVE golf VI gti ET GTD sanS sigle neuve
                   DE DISPO AUSSI DES CALES 20MM AVEC GOUJON 5/112
                   DE DISPO 2 JANTE DETROIT GTI EN 19 A REPEINDRE IDEAL";
        $lorem2 = "Joli débardeur couleur marron chocolat avec détail de pierres turquoises autour du décolleté,
                   de la marque italienne apepazza. 95% coton et 5% spandex.
                   Porté une seule fois, en parfait état, taille L (correspond au 42).
                    Contactez-nous au 04.93.99.25.50.";

        $lorem3 = "Mobile conçu pour apaiser bébé met en scène de jolis oursons. Une fonction projection fait de la chambre de bébé une douce nuit étoilée.
                    6 sons au choix (berceuse, classique, sons de la nature, musiques relaxantes...) et de nombreuses variations de lumières. 2 positions:
                    il s'attache aux barreaux du lit ou se pose sur la commode de la chambre. Astucieux : la télécommande permet à la maman de déclencher
                    le mobile à distance. Fonctionne avec 2 piles LR6 (télécommande) et 4 piles LR20 (mobile), non fournies.
                    Très bon état. Envoi possible";

        $lorem4 = "Sony xperia E bloque sur SFR vendu dans sa boite avec tous ses accessoires";

        $lorem5 = "royeur professionnel pour broyer sans effort des grandes quantitées de végétaux et des branches jusqu'à 9 cm diamètre.

                    Le broyeur dans la classe compact qui fonctionne comme il faut:
                    Moteur Honda tres fiable avec une longue duree de vie (garantie 3 ans).

                    Éjection des copeaux directement dans la remorque, benne ou brouet.

                    Auto-alimentation. Pas besoin de pousser
                    La goulotte d'éjection ne se bouche pas

                    Idéal pour elagueur, espaces verts et paysagiste.

                    Les avantages:
                    - compact
                    - rapide: jusqu'à 5 m3 de branches/h ou 24 stères/h
                    - auto alimentation
                    - pièces détachées de haute qualité
                    - construction tres rigide
                    - moteur Honda GX 390 13 ch. - 4 temps (Euro 95)
                    - construction Européenne
                    - SAV rapide et efficace
                    - livraison dans toute la France

                    Prix, fiches techniques et liens pour vidéo de démonstration sur demande par email (marquez votre code postal)";

        $lorem6 = 'Vend iMac de 2009 24"
                    Parfait etat suivie par Apple Store de lyon
                    Aucun défaut vendu avec sourie apple et clavier filaire
                    Os Maverick a jour

                    Côté 930Euro(s)
                    Vendu 850Euro(s) ou échange contre MacBook même cote

                    Pas sérieux s\'abstenir , pas d\'autre échange merci';
        $picture1 = "mini.jpeg";
        $picture2 = "ferrari.jpeg";
        $picture3 = "imac.png";
        $picture4 = "photo.jpg";
        $picture5 = "ordi.jpeg";
        $picture6 = "concert.jpeg";
        $picture7 = "porshe.jpeg";
        $picture8 = "tel.jpeg";

        // Creation des categorys Multimédia
        $annonce1  = $this->createAnnonce('Calandre VW NEUVE golf 6 GTi ET GTD',
            $lorem1,
            $this->getReference('ville-tul'),
            '3000',
            $this->getReference('category-1'),
            $this->getReference('user'),
            $picture1);

        $annonce2  = $this->createAnnonce('Joli débardeur avec détail décolleté turquoise',
            $lorem2,
            $this->getReference('ville-nic'),
            '1120',
            $this->getReference('category-2'),
            $this->getReference('user-2'),
            $picture2);

        $annonce3  = $this->createAnnonce('MacBook Pro 2012 13Pouces',
            $lorem6,
            $this->getReference('ville-vin'),
            '1000',
            $this->getReference('category-3'),
            $this->getReference('user-2'),
            $picture3);

        $annonce4  = $this->createAnnonce('Sony xperia E operateur sfr',
            $lorem4,
            $this->getReference('ville-mar'),
            '50',
            $this->getReference('category-4'),
            $this->getReference('user'),
            $picture4);

        $annonce5  = $this->createAnnonce('Téléphone portable Iphone 4S niquel',
            $lorem,

            $this->getReference('ville-psg'),
            '3200',
            $this->getReference('category-1'),
            $this->getReference('user-1'),
            $picture8);

        $annonce6  = $this->createAnnonce('Un titre d\'annonce je sais pas',
            $lorem,
            $this->getReference('ville-vin'),
            '1000',
            $this->getReference('category-1'),
            $this->getReference('user-1'),
            $picture5);

        $annonce7  = $this->createAnnonce('Une porsche 911 cabriolet noir parfait état !',
            $lorem,
            $this->getReference('ville-tul'),
            NULL,
            $this->getReference('category-1'),
            $this->getReference('user-2'),
            $picture4);

        $annonce8  = $this->createAnnonce('Broyeur de branches compact -PRO-',
            $lorem5,
            $this->getReference('ville-vin'),
            '50',
            $this->getReference('category-1'),
            $this->getReference('user'),
            $picture6);

        $annonce9  = $this->createAnnonce('Opel Corsa bleu',
            $lorem,
            $this->getReference('ville-vin'),
            '100000',
            $this->getReference('category-1'),
            $this->getReference('user'),
            $picture2);

        $annonce10 = $this->createAnnonce('10 CD d\'Elvis presley !',
            $lorem,
            $this->getReference('ville-vin'),
            '1000',
            $this->getReference('category-1'),
            $this->getReference('user-2'),
            $picture7);

        $annonce11 = $this->createAnnonce('Mobile Doux Rêves Papillons Fisher Price',
            $lorem3,
            $this->getReference('ville-vin'),
            '1000',
            $this->getReference('category-1'),
            $this->getReference('user-2'),
            $picture6);

        $annonce12 = $this->createAnnonce('Canapé d\'angle 6 places taupe',
            $lorem,
            $this->getReference('ville-vin'),
            '1000',
            $this->getReference('category-1'),
            $this->getReference('user-1'),
            $picture5);

        // Enregistrement des annonces
        /*$manager->persist($annonce1);
        $manager->persist($annonce2);
        $manager->persist($annonce3);
        $manager->persist($annonce4);
        $manager->persist($annonce5);
        $manager->persist($annonce6);
        $manager->persist($annonce7);
        $manager->persist($annonce8);
        $manager->persist($annonce9);
        $manager->persist($annonce10);
        $manager->persist($annonce11);
        $manager->persist($annonce12);*/


        //$manager->flush();
    }

    // Fonction de création globale
    private function createAnnonce($title, $content,$ville, $price, $category , $user, $picture) {

        /*$annonce = new  Annonce();
        $annonce->setTitle($title)
                ->setContent($content)
                ->setRegion($region)
                ->setDepartement($departement)
                ->setVille($ville)
                ->setPrice($price)
                ->setcategory($category)
                ->setUser($user)
                ->setPicture($picture);

        return $annonce;*/
    }

    public function getOrder()
    {
        return 20;
    }

}