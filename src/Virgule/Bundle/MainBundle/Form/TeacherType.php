<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeacherType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('isActive', 'checkbox', array(
                    'required'  => false,
                    'attr'      => array('checked'   => 'checked'),
                ))
                ->add('lastName')
                ->add('firstName')
                ->add('phoneNumber')
                ->add('cellphoneNumber')
                ->add('email')
                ->add('username')
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Les mots de passe ne correspondent pas',
                    'options' => array('label' => 'Mot de passe'),
                    'attr'    => array('data-indicator' => 'pwindicator')
                ))
                /*->add('registrationDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date')
                ))*/
                ->add('role', 'entity', array(
                    'class' => 'VirguleMainBundle:Role',
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'label',
                    'property_path' => 'role',            
                    'attr' => array('class' => 'small-select')
                 ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\Teacher'
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_teachertype';
    }
    
    public function getDefaultOptions() {
        return array(
            'validation_groups' => array('Registration', 'Default')
        );
    }

}
