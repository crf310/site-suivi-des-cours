<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClassSessionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $now = new \DateTime('now');
        $sNow = $now->format('d/m/Y');
        $builder
                ->add('date', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'date', 'value' => $sNow)))
                ->add('summary', 'ckeditor', array(
                        'config' => array(
                            'toolbar' => array(
                                array(
                                    'name'  => 'document',
                                    'items' => array('Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates'),
                                ),
                                '/',
                                array(
                                    'name'  => 'basicstyles',
                                    'items' => array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'),
                                ),
                            ),
                            'ui_color' => '#ffffff'
                        )));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassSession'
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_classsessiontype';
    }

}
