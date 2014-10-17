<?php

namespace Tinkernote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="Tinkernote\SiteBundle\Entity\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Departement")
     * @ORM\JoinColumn(nullable = false)
     */
    private $departement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=128)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="postal", type="integer", length=5)
     */
    private $postal;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Ville
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Ville
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set postal
     *
     * @param integer $postal
     * @return Ville
     */
    public function setPostal($postal)
    {
        $this->postal = $postal;

        return $this;
    }

    /**
     * Get postal
     *
     * @return integer 
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Set departement
     *
     * @param \Tinkernote\SiteBundle\Entity\Departement $departement
     * @return Ville
     */
    public function setDepartement(\Tinkernote\SiteBundle\Entity\Departement $departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \Tinkernote\SiteBundle\Entity\Departement 
     */
    public function getDepartement()
    {
        return $this->departement;
    }
}
