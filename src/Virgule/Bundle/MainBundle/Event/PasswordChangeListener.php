<?php

namespace Virgule\Bundle\MainBundle\Event;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\UserBundle\Doctrine\UserManager;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class PasswordChangeListener implements EventSubscriberInterface {

  private $router;
  private $container;
  private $userManager;

  public function __construct(UrlGeneratorInterface $router, ContainerInterface $container, UserManager $userManager) {
    $this->router = $router;
    $this->container = $container;
    $this->userManager = $userManager;
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

    $expirationDate = new \DateTime("now");
    $permanentCredentialsDays = $this->container->getParameter('permanent_credentials_days');
    $expirationDate->modify("+" . $permanentCredentialsDays . " day");
    $user->setCredentialsExpireAt($expirationDate);
    $this->userManager->updateUser($user);

    $url = $this->router->generate('teacher_show', array('id' => $user->getId()));
    $event->setResponse(new RedirectResponse($url));
  }

}

?>
