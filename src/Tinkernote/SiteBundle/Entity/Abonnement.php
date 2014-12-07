<?php

namespace Tinkernote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity(repositoryClass="Tinkernote\SiteBundle\Entity\AbonnementRepository")
 */
class Abonnement
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
     * @ORM\ManyToOne(targetEntity="Tinkernote\UserBundle\Entity\User")
     */
    private $followed;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\UserBundle\Entity\User")
     */
    private $follower;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actived", type="boolean")
     */
    private $actived;


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
     * @return Abonnement
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
     * @return Abonnement
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
     * Set followed
     *
     * @param \Tinkernote\UserBundle\Entity\User $followed
     * @return Abonnement
     */
    public function setFollowed(\Tinkernote\UserBundle\Entity\User $followed = null)
    {
        $this->followed = $followed;

        return $this;
    }

    /**
     * Get followed
     *
     * @return \Tinkernote\UserBundle\Entity\User 
     */
    public function getFollowed()
    {
        return $this->followed;
    }

    /**
     * Set follower
     *
     * @param \Tinkernote\UserBundle\Entity\User $follower
     * @return Abonnement
     */
    public function setFollower(\Tinkernote\UserBundle\Entity\User $follower = null)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get follower
     *
     * @return \Tinkernote\UserBundle\Entity\User 
     */
    public function getFollower()
    {
        return $this->follower;
    }
}
