<?php

namespace Tinkernote\SiteBundle\Services;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Tinkernote\SiteBundle\Entity\Activity\AnnonceActivity;

class Activity {

    protected $em;
    protected $securityContext;

    public function __construct($doctrine, SecurityContext $securityContext)
    {
        $this->em = $doctrine->getManager();
        $this->securityContext = $securityContext;
    }

    public function updateAnnonceActivity($id, $owner, $type)
    {

        $user = $this->securityContext->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            $user = null;
        }

        $activity_repository = $this->em->getRepository('SiteBundle:Activity\ActivityType');

        if($type === 1) {
            $activityType = $activity_repository->findOneBy(array('id' => 1));
            $content = "a été lu";
        }
        else{
            $activityType = $activity_repository->findOneBy(array('id' => 2));
            $content = "a commenté";
        }

        $activity = new AnnonceActivity();

        $activity->setContent($content);
        $activity->setAnnonce($id);
        $activity->setOwner($owner);
        $activity->setUser($user);
        $activity->setActivityType($activityType);
        //$activity->setComment($comment); A IMPLENTER

        $this->em->persist($activity);
        $this->em->flush();

        return true;
    }
} 