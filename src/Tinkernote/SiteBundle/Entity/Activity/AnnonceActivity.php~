<?php

namespace Tinkernote\SiteBundle\Entity\Activity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnonceActivity
 *
 * @ORM\Table(name="annonce_activity")
 * @ORM\Entity(repositoryClass="Tinkernote\SiteBundle\Entity\Activity\AnnonceActivityRepository")
 */
class AnnonceActivity
{
    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Annonce")
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\UserBundle\Entity\User")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Activity\ActivityType")
     */
    private $activity_type;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var int
     * @ORM\Column(name="lecture", type="integer")
     */
    private $lecture;

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
     * Set annonce
     *
     * @param \Tinkernote\SiteBundle\Entity\Annonce $annonce
     * @return AnnonceActivity
     */
    public function setAnnonce(\Tinkernote\SiteBundle\Entity\Annonce $annonce = null)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \Tinkernote\SiteBundle\Entity\Annonce 
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * Set owner
     *
     * @param \Tinkernote\UserBundle\Entity\User $owner
     * @return AnnonceActivity
     */
    public function setOwner(\Tinkernote\UserBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \Tinkernote\UserBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set activity_type
     *
     * @param \Tinkernote\SiteBundle\Entity\ActivityType $activityType
     * @return AnnonceActivity
     */
    public function setActivityType(\Tinkernote\SiteBundle\Entity\Activity\ActivityType $activityType = null)
    {
        $this->activity_type = $activityType;

        return $this;
    }

    /**
     * Get activity_type
     *
     * @return \Tinkernote\SiteBundle\Entity\Activity\ActivityType
     */
    public function getActivityType()
    {
        return $this->activity_type;
    }

    /**
     * Set lecture
     *
     * @param integer $lecture
     * @return AnnonceActivity
     */
    public function setLecture($lecture)
    {
        $this->lecture = $lecture;

        return $this;
    }

    /**
     * Get lecture
     *
     * @return integer 
     */
    public function getLecture()
    {
        return $this->lecture;
    }
}
