<?php

namespace Tinkernote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Picture", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $picture;

    // Lien vers l'image en relation
    /**
     *
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Picture", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     *
     */
    private $picturetwo;

    // Lien vers l'image en relation
    /**
     *
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Picture", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $picturethree;

    // Lien vers l'image en relation
    /**
     *
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Picture", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $picturefour;

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
     * @ORM\Column(name="title", type="string", length=80)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z_0-9]/",
     *     message="Votre titre ne peut contenir que des chiffres et lettres"
     * )
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
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Un tarif ne peut contenir que des chiffres"
     * )
     */
    private $price;

    public function __construct()
    {
        $this->date = new \DateTime();
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
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
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
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
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
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
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
     * Get user
     *
     * @return \Tinkernote\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
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
     * Get ville
     *
     * @return \Tinkernote\SiteBundle\Entity\Ville 
     */
    public function getVille()
    {
        return $this->ville;
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
     * Get category
     *
     * @return \Tinkernote\SiteBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set picture
     *
     * @param \Tinkernote\SiteBundle\Entity\Picture $picture
     * @return Annonce
     */
    public function setPicture(\Tinkernote\SiteBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Tinkernote\SiteBundle\Entity\Picture 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set picturetwo
     *
     * @param \Tinkernote\SiteBundle\Entity\Picture $picturetwo
     * @return Annonce
     */
    public function setPicturetwo(\Tinkernote\SiteBundle\Entity\Picture $picturetwo = null)
    {
        $this->picturetwo = $picturetwo;

        return $this;
    }

    /**
     * Get picturetwo
     *
     * @return \Tinkernote\SiteBundle\Entity\Picture 
     */
    public function getPicturetwo()
    {
        return $this->picturetwo;
    }

    /**
     * Set picturethree
     *
     * @param \Tinkernote\SiteBundle\Entity\Picture $picturethree
     * @return Annonce
     */
    public function setPicturethree(\Tinkernote\SiteBundle\Entity\Picture $picturethree = null)
    {
        $this->picturethree = $picturethree;

        return $this;
    }

    /**
     * Get picturethree
     *
     * @return \Tinkernote\SiteBundle\Entity\Picture 
     */
    public function getPicturethree()
    {
        return $this->picturethree;
    }

    /**
     * Set picturefour
     *
     * @param \Tinkernote\SiteBundle\Entity\Picture $picturefour
     * @return Annonce
     */
    public function setPicturefour(\Tinkernote\SiteBundle\Entity\Picture $picturefour = null)
    {
        $this->picturefour = $picturefour;

        return $this;
    }

    /**
     * Get picturefour
     *
     * @return \Tinkernote\SiteBundle\Entity\Picture 
     */
    public function getPicturefour()
    {
        return $this->picturefour;
    }
}
