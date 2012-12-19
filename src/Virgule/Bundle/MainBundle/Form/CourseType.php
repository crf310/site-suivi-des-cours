<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dayOfWeek')
            ->add('startTime')
            ->add('endTime')
            ->add('alternateStartdate')
            ->add('alternateEnddate')
            ->add('fkLevelId')
            ->add('fkSemesterId')
            ->add('fkTeacherId')
            ->add('fkOrganizationBranch')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\Course'
        ));
    }

    public function getName()
    {
        return 'virgule_bundle_mainbundle_coursetype';
    }
}
