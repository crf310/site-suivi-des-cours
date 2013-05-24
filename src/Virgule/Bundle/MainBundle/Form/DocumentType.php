<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder          
            ->add('fileName')
            ->add('description')
            ->add('file', 'file')
            ->add('classLevel', 'entity', array(
                'class' => 'VirguleMainBundle:ClassLevel',
                'expanded' => false,
                'multiple' => true,
                'property' => 'label',
                'property_path' => 'classlevel',            
                'attr' => array('class' => 'medium-select')
             ))
            ->add('tags', 'collection', array(
                'type'         => new TagType(),
                'allow_add'    => true,
                'by_reference' => false,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\Document'
        ));
    }

    public function getName()
    {
        return 'virgule_bundle_mainbundle_documenttype';
    }
}
