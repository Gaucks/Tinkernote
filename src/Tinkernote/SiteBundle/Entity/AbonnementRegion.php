<?php

namespace Tinkernote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbonnementRegion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tinkernote\SiteBundle\Entity\AbonnementRegionRepository")
 */
class AbonnementRegion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Region")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\UserBundle\Entity\User")
     */
    private $user;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actived", type="boolean")
     */
    private $actived;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    public function __construct()
    {
        $this->date = new \DateTime();
        $this->actived = true;
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
     * Set date
     *
     * @param \DateTime $date
     * @return AbonnementRegion
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
     * Set actived
     *
     * @param boolean $actived
     * @return AbonnementRegion
     */
    public function setActived($actived)
    {
        $this->actived = $actived;

        return $this;
    }

    /**
     * Get actived
     *
     * @return boolean 
     */
    public function getActived()
    {
        return $this->actived;
    }

    /**
     * Set region
     *
     * @param \Tinkernote\SiteBundle\Entity\Region $region
     * @return AbonnementRegion
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
     * Set user
     *
     * @param \Tinkernote\UserBundle\Entity\User $user
     * @return AbonnementRegion
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
}
