<?php

namespace Virgule\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Virgule\Bundle\MainBundle\Form\EventListener\PatchSubscriber;
use Virgule\Bundle\MainBundle\Form\EventListener\SetInactiveTeacherSubscriber;

class TeacherType extends AbstractType {

  private $intention;

  public function __construct($intention = 'create') {
    $this->intention = $intention;
  }

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $passwordRequired = true;
    if ($this->intention == 'edit') {
      $passwordRequired = false;
      $builder->setMethod('PATCH');
    } else {
      $builder->add('username');
    }

    $builder
            ->add('isActive', 'choice', array(
                'choices' => array('1' => 'Actif', '0' => 'Inactif'),
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'cols_number' => 2
            ))
            ->add('lastName')
            ->add('firstName')
            ->add('phoneNumber')
            ->add('cellphoneNumber')
            ->add('email')
            ->add('role', 'entity', array(
                'class' => 'VirguleMainBundle:Role',
                'expanded' => false,
                'multiple' => false,
                'property' => 'label',
                'property_path' => 'role',
                'attr' => array('class' => 'small-select')
    ));
    $patchSubscriber = new PatchSubscriber();
    $builder->addEventSubscriber($patchSubscriber);
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    if ($this->intention == 'edit') {
      $validationGroup = 'Profile';
    } else {
      $validationGroup = 'Registration';
    }

    $resolver->setDefaults(array(
        'data_class' => 'Virgule\Bundle\MainBundle\Entity\Teacher',
        'validation_groups' => array($validationGroup, 'Default')
    ));
  }

  public function getName() {
    return 'virgule_bundle_mainbundle_teachertype';
  }

}
