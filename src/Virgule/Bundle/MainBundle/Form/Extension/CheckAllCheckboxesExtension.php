<?php

namespace Virgule\Bundle\MainBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CheckAllCheckboxesExtension extends AbstractTypeExtension {

  /**
   * Returns the name of the type being extended.
   *
   * @return string The name of the type being extended
   */
  public function getExtendedType() {
    return 'choice';
  }

  /**
   * Add the add_check_all option
   *
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setOptional(array('add_check_all'));
  }

  /**
   * Pass the add_check_all value to the view
   *
   * @param FormView $view
   * @param FormInterface $form
   * @param array $options
   */
  public function buildView(FormView $view, FormInterface $form, array $options) {

    if (array_key_exists('add_check_all', $options)) {
      $view->vars['add_check_all'] = $options['add_check_all'];
    } else {
      $options['cols_number'] = false;
    }
  }

}

?>
