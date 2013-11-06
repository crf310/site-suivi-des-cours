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
            ->add('fileName', 'text')
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
            ->add('tags', 'text', array(
                'label' => 'Tags',
                'mapped' => false,
                'required' => false,
                'attr' => array('class' => 'tagManager', 'placeholder' => 'Tags', 'name' => 'tags', 'data-provide' => 'typeahead'))
                )
            /*
            ->add('tags', 'collection', array(
                'type'         => new TagType(),
                'allow_add'    => true,
                'by_reference' => false,
                'required' => false,
                'label' => 'Tags',          
                'attr' => array('class' => 'input-medium')
            ))*/
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
        return 'document';
    }
}
