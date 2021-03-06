<?php

namespace Tinkernote\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Tinkernote\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\UserBundle\Entity\Avatar")
     */
    protected  $avatar;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Ville")
     */
    protected  $ville;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z_]+$/",
     *     message="Votre prénom ne peut contenir que des lettres"
     * )
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z_]+$/",
     *     message="Votre nom ne peut contenir que des lettres"
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="integer", length=10, nullable=true)
     * @Assert\Length(
     *      min = "9",
     *      max = "10",
     *      minMessage = "Votre numéro doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Votre numéro ne peut pas être plus long que {{ limit }} caractères."
     * )
     */
    protected $phone;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $showphone;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $age;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $finalword;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_activity;

    public function __construct()
    {
        parent::__construct();
        $this->showphone = true;
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set showphone
     *
     * @param boolean $showphone
     * @return User
     */
    public function setShowphone($showphone)
    {
        $this->showphone = $showphone;

        return $this;
    }

    /**
     * Get showphone
     *
     * @return boolean 
     */
    public function getShowphone()
    {
        return $this->showphone;
    }

    /**
     * Set age
     *
     * @param \DateTime $age
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return \DateTime 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set region
     *
     * @param \Tinkernote\SiteBundle\Entity\Region $region
     * @return User
     */
    public function setRegion(\Tinkernote\SiteBundle\Entity\Region $region = null)
    {
        $this->region = $region;

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
     * Set departement
     *
     * @param \Tinkernote\SiteBundle\Entity\Departement $departement
     * @return User
     */
    public function setDepartement(\Tinkernote\SiteBundle\Entity\Departement $departement = null)
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

    /**
     * Set ville
     *
     * @param \Tinkernote\SiteBundle\Entity\Ville $ville
     * @return User
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
     * Set avatar
     *
     * @param \Tinkernote\UserBundle\Entity\Avatar $avatar
     * @return User
     */
    public function setAvatar(\Tinkernote\UserBundle\Entity\Avatar $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \Tinkernote\UserBundle\Entity\Avatar 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set finalword
     *
     * @param string $finalword
     * @return User
     */
    public function setFinalword($finalword)
    {
        $this->finalword = $finalword;

        return $this;
    }

    /**
     * Get finalword
     *
     * @return string 
     */
    public function getFinalword()
    {
        return $this->finalword;
    }

    /**
     * Set last_activity
     *
     * @param \DateTime $lastActivity
     * @return User
     */
    public function setLastActivity($lastActivity)
    {
        $this->last_activity = $lastActivity;

        return $this;
    }

    /**
     * Get last_activity
     *
     * @return \DateTime 
     */
    public function getLastActivity()
    {
        return $this->last_activity;
    }

    /* Liste des method utilise pour l'affiche  des utilisateurs connectés */
    public function isOnline()
    {
        $now = new \DateTime();
        $now->modify('-5 minutes');
        return $this->getLastActivity() > $now;
    }
}
