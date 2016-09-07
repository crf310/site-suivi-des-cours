<?php

namespace Virgule\Bundle\MainBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ManyColsBoxesTypeExtension extends AbstractTypeExtension {

  /**
   * Returns the name of the type being extended.
   *
   * @return string The name of the type being extended
   */
  public function getExtendedType() {
    return 'choice';
  }

  /**
   * Add the rows_number option
   *
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setOptional(array('cols_number'));
  }

  /**
   * Pass the rows number to the view
   *
   * @param FormView $view
   * @param FormInterface $form
   * @param array $options
   */
  public function buildView(FormView $view, FormInterface $form, array $options) {

    if (array_key_exists('cols_number', $options)) {
      $view->vars['cols_number'] = $options['cols_number'];
    } else {
      $options['cols_number'] = 1;
    }
  }

}

?>
