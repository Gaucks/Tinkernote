<?php

namespace Tinkernote\SiteBundle\Entity\Activity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbonnementActivity
 *
 * @ORM\Table(name="abonnementActivity")
 * @ORM\Entity(repositoryClass="Tinkernote\SiteBundle\Entity\Activity\AbonnementActivityRepository")
 */
class AbonnementActivity
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

    public function __construct(){
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
     * Set date
     *
     * @param \DateTime $date
     * @return AbonnementActivity
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
     * Set followed
     *
     * @param \Tinkernote\UserBundle\Entity\User $followed
     * @return AbonnementActivity
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
     * @return AbonnementActivity
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
