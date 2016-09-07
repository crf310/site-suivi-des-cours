<?php

namespace Virgule\Bundle\MainBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WelcomeDateTypeExtension extends AbstractTypeExtension {

  /**
   * Returns the name of the type being extended.
   *
   * @return string The name of the type being extended
   */
  public function getExtendedType() {
    return 'date';
  }

  /**
   * Add the open_houses_dates option
   *
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setOptional(array('open_houses_dates'));
  }

  /**
   * Pass the open houses dates to the view
   *
   * @param FormView $view
   * @param FormInterface $form
   * @param array $options
   */
  public function buildView(FormView $view, FormInterface $form, array $options) {

    if (array_key_exists('open_houses_dates', $options)) {
      $view->vars['open_houses_dates'] = $options['open_houses_dates'];
    }
  }

}

?>
