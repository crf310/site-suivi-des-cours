<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class TeacherChangePasswordType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('current_password', 'password', array(
                    'label' => 'Mot de passe actuel',
                    'mapped' => false,
                    'constraints' => new UserPassword(),
                ))    
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'required' => true,
                    'invalid_message' => 'Les mots de passe ne correspondent pas',
                    'options' => array('label' => 'Mot de passe'),
                    'attr'    => array('data-indicator' => 'pwindicator')
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\Teacher'
        ));
    }
    
    public function getName() {
        return 'virgule_bundle_mainbundle_teacherchangepasswordtype';
    }
    
    public function getDefaultOptions() {
        return array(
            'validation_groups' => array('Registration', 'Default')
        );
    }
}
