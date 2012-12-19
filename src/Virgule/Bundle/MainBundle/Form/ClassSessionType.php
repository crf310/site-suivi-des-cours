<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClassSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('summary')
            ->add('fkClassId')
            ->add('fkSessionTeacherId')
            ->add('fkSummaryTeacherId')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassSession'
        ));
    }

    public function getName()
    {
        return 'virgule_bundle_mainbundle_classsessiontype';
    }
}
