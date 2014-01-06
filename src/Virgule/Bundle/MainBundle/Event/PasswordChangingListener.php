<?php

namespace Virgule\Bundle\MainBundle\Event;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class PasswordChangingListener implements EventSubscriberInterface {

    private $router;
    private $container;

    public function __construct(UrlGeneratorInterface $router, ContainerInterface $container) {
        $this->router = $router;
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents() {
        return array(
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => 'onPasswordChangingSuccess',
        );
    }

    public function onPasswordChangingSuccess(FormEvent $event) {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $url = $this->router->generate('teacher_show', array('id' => $user->getId()));

        $event->setResponse(new RedirectResponse($url));
    }

}
?>