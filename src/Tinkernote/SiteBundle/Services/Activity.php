<?php

namespace Tinkernote\SiteBundle\Services;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Tinkernote\SiteBundle\Entity\Activity\AnnonceActivity;
use Tinkernote\SiteBundle\Entity\Activity\CommentActivity;

class Activity {

    protected $em;
    protected $securityContext;

    public function __construct($em, SecurityContext $securityContext)
    {
        $this->em = $em->getManager();
        $this->securityContext = $securityContext;
    }

    public function updateAnnonceActivity($id, $owner, $type, $comment)
    {
        $user = $this->securityContext->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            $user = null;
        }


            if($owner != $user) // L'utilisateur n'est pas l'auteur de l'annonce
            {
                $activity_repository = $this->em->getRepository('SiteBundle:Activity\ActivityType');
                $activity = $this->em->getRepository('SiteBundle:Activity\AnnonceActivity')->findOneBy(array('annonce' => $id));

                if (!$activity) { // Si il n'y a pas d'activité sur cette annonce
                        $this->createActivity($id, $user, $owner, $type, $activity_repository, $comment);
                } else { // Si il y a déja une activité d'enregistré :
                    if ($type == 2) { // Si le type est un commentaire on l'enregistre sinon on update
                        $this->createActivity($id, $user, $owner, $type, $activity_repository, $comment);
                    } else {
                        $this->updateActivity($activity);
                    }
                }
            }
    }

    private function createActivity($id, $user, $owner, $type, $activity_repository, $comment)
    {
        if($type === 1) {
            $activityType = $activity_repository->findOneBy(array('id' => 1));
            $content = "a été lu";

            $activity = new AnnonceActivity();

            $activity->setContent($content);
            $activity->setAnnonce($id);
            $activity->setOwner($owner);
            $activity->setActivityType($activityType);
            $activity->setLecture(1);

            $this->em->persist($activity);
            $this->em->flush();

        }
        else{
            $activityType = $activity_repository->findOneBy(array('id' => 2));
            $content = "a commenté";

            $commentActivity = new CommentActivity();

            $commentActivity->setContent($content);
            $commentActivity->setAnnonce($id);
            $commentActivity->setUser($user);
            $commentActivity->setActivityType($activityType);
            $commentActivity->setComment($comment);

            $this->em->persist($commentActivity);
            $this->em->flush();
        }
    }

    private function updateActivity($activity)
    {
        $lecture = $activity->getLecture();
        $lecture = $lecture+1;

        $activity->setLecture($lecture);

        $this->em->flush();
    }
} 