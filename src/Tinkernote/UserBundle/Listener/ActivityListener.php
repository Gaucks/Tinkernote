<?php

namespace Tinkernote\UserBundle\Listener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\User\UserInterface;

class ActivityListener
{
    /**
     * @var SecurityContext
     */
    protected $context;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContext(SecurityContext $context = null)
    {
        $this->context = $context;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function onCoreController(FilterControllerEvent $event)
    {
        $em = $this->container->get('doctrine')->getManager();
        $token = $this->context->getToken();

        if(isset($token)) $user = $token->getUser();
        if(isset($user) && $user instanceof UserInterface) {
            $user->setLastActivity(new \DateTime());
            $em->persist($user);
            $em->flush();
        }

    }
}