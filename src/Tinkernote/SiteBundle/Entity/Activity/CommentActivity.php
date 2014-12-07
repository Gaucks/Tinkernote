<?php

namespace Tinkernote\SiteBundle\Entity\Activity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentActivity
 *
 * @ORM\Table(name="comment_activity")
 * @ORM\Entity(repositoryClass="Tinkernote\SiteBundle\Entity\Activity\CommentActivityRepository")
 */
class CommentActivity {
    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Annonce")
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Comment")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\SiteBundle\Entity\Activity\ActivityType")
     */
    private $activity_type;

    /**
     * @ORM\ManyToOne(targetEntity="Tinkernote\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

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
     * @return CommentActivity
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
     * @return CommentActivity
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
     * @return CommentActivity
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
     * Set comment
     *
     * @param \Tinkernote\SiteBundle\Entity\Comment $comment
     * @return CommentActivity
     */
    public function setComment(\Tinkernote\SiteBundle\Entity\Comment $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return \Tinkernote\SiteBundle\Entity\Comment 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set activity_type
     *
     * @param \Tinkernote\SiteBundle\Entity\Activity\ActivityType $activityType
     * @return CommentActivity
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
     * Set user
     *
     * @param \Tinkernote\UserBundle\Entity\User $user
     * @return CommentActivity
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
