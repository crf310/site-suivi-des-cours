<?php

namespace Virgule\Bundle\MainBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

/**
 * Changes Form->submit() behavior so that it treats not set values as if they
 * were sent unchanged.
 *
 * Use when you don't want fields to be set to NULL when they are not displayed
 * on the page (or to implement PUT/PATCH requests).
 * @link https://gist.github.com/makasim/3720535 for more information
 */
class PatchSubscriber implements EventSubscriberInterface {

  public function onPreSubmit(FormEvent $event) {
    $form = $event->getForm();
    $clientData = $event->getData();
    $clientData = array_replace($this->prepareData($form), $clientData ? : array());
    $event->setData($clientData);
  }

  /**
   * Returns the form's data like $form->submit() expects it
   */
  protected function prepareData($form) {
    if ($form->count()) {
      $data = array();
      foreach ($form->all() as $name => $child) {
        $data[$name] = $this->prepareData($child);
      }
      return $data;
    } else {
      return $form->getViewData();
    }
  }

  static public function getSubscribedEvents() {
    return array(
        FormEvents::PRE_SUBMIT => 'onPreSubmit',
    );
  }

}
