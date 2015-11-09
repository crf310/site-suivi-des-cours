<?php

namespace Virgule\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OpenHouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'datepicker','data-date-format' => 'dd/mm/yyyy')
            ))
            ->add('startTime', 'time', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'hours' => array(8,9,10,11,12,13,14,15,16,17,18,19,20,21,22),
                'minutes' => array('00','15','30','45')
            ))
            ->add('endTime', 'time', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'hours' => array(8,9,10,11,12,13,14,15,16,17,18,19,20,21,22),
                'minutes' => array('00','15','30','45')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\OpenHouse'
        ));
    }

    public function getName()
    {
        return 'virgule_bundle_mainbundle_openhousetype';
    }
}
