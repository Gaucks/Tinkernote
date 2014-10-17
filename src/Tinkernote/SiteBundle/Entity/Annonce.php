<?php

namespace Tinkernote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="Tinkernote\SiteBundle\Entity\AnnonceRepository")
 */
class Annonce
{

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\UserBundle\Entity\User")
     */
    private $user;

    // DANS QUEL REGION IL SE SITUE
    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Region")
     */
    private  $region;

    // Quel département
    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Departement")
     */
    private $departement;

    // Quel ville
    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Ville")
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\ParentCategory")
     */
    private $parentCategory;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Category")
     */
    private $category;

    // Lien vers l'image en relation
    /**
     * @var string
     *
     * @ORM\Column(name="picture", nullable=true)
     */
    private $picture;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Annonce
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Annonce
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Annonce
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Annonce
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Annonce
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Tinkernote\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param \Tinkernote\UserBundle\Entity\User $user
     * @return Annonce
     */
    public function setUser(\Tinkernote\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Tinkernote\SiteBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set region
     *
     * @param \Tinkernote\SiteBundle\Entity\Region $region
     * @return Annonce
     */
    public function setRegion(\Tinkernote\SiteBundle\Entity\Region $region = null)
    {
        $this->region = $region;

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

    /**
     * Set departement
     *
     * @param \Tinkernote\SiteBundle\Entity\Departement $departement
     * @return Annonce
     */
    public function setDepartement(\Tinkernote\SiteBundle\Entity\Departement $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Tinkernote\SiteBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set ville
     *
     * @param \Tinkernote\SiteBundle\Entity\Ville $ville
     * @return Annonce
     */
    public function setVille(\Tinkernote\SiteBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Tinkernote\SiteBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param \Tinkernote\SiteBundle\Entity\Category $category
     * @return Annonce
     */
    public function setCategory(\Tinkernote\SiteBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get parentCategory
     *
     * @return \Tinkernote\SiteBundle\Entity\ParentCategory
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }

    /**
     * Set parentCategory
     *
     * @param \Tinkernote\SiteBundle\Entity\ParentCategory $parentCategory
     * @return Annonce
     */
    public function setParentCategory(\Tinkernote\SiteBundle\Entity\ParentCategory $parentCategory = null)
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }
}
