<?php

namespace Virgule\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClassLevelType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('label')
            ->add('htmlColorCode', 'text', array(
                'attr' => array('class' => 'colorpicker input-small', 'value' => '#000000', 'data-color' => '#000000'),
            ))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassLevel'
    ));
  }

  public function getName() {
    return 'virgule_bundle_mainbundle_classleveltype';
  }

}
