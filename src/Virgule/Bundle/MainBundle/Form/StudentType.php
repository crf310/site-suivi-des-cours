<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('registrationDate')
            ->add('lastname')
            ->add('firstname')
            ->add('birthdate')
            ->add('phoneNumber')
            ->add('cellphoneNumber')
            ->add('address')
            ->add('zipcode')
            ->add('city')
            ->add('gender')
            ->add('nationality')
            ->add('maritalStatus')
            ->add('commentaires')
            ->add('registringDate')
            ->add('picturePath')
            ->add('arrivalDate')
            ->add('scholarized')
            ->add('profession')
            ->add('scholarizedInTheCountry')
            ->add('scholarizedInAForeignCountry')
            ->add('scholarizationLevel')
            ->add('emergencyContactLastname')
            ->add('emergencyContactFirstname')
            ->add('emergencyContactPhoneNumber')
            ->add('emergencyContactConnectionType')
            ->add('fkProposedLevel')
            ->add('fkNativeCountry')
            ->add('fkScholarizationLanguage')
            ->add('fkMotherTongue')
            ->add('fkWelcomedByTeacher')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\Student'
        ));
    }

    public function getName()
    {
        return 'virgule_bundle_mainbundle_studenttype';
    }
}
