<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CourseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dayOfWeek', 'choice', array(
                    'expanded' => false,
                    'choices' => array('1' => 'Lundi', 'Mardi', 'Mercredi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'),
                    'data' => '1',
                ))
                ->add('startTime')
                ->add('endTime')
                ->add('alternateStartdate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date'),
                    'required'  => false
                ))
                ->add('alternateEnddate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date'),
                    'required'  => false
                ))
                ->add('classLevel')
                ->add('teachers')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\Course'
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_coursetype';
    }

}
