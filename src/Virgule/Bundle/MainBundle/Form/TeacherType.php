<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isActive')
            ->add('lastName')
            ->add('firstName')
            ->add('phoneNumber')
            ->add('cellphoneNumber')
            ->add('emailAddress')
            ->add('username')
            ->add('password')
            ->add('registrationDate')
            ->add('lastConnectionDate')
            ->add('fkRoleId')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\Teacher'
        ));
    }

    public function getName()
    {
        return 'virgule_bundle_mainbundle_teachertype';
    }
}
