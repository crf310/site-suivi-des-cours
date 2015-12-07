<?php

namespace Virgule\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('fileName', 'text')
            ->add('description')
            ->add('file', 'file')
            ->add('classLevels', 'entity', array(
                'class' => 'VirguleMainBundle:ClassLevel',
                'expanded' => false,
                'multiple' => true,
                'property' => 'label',
                'required' => false,
                'property_path' => 'classLevels'
            ))
            ->add('tags', 'text', array(
                'label' => 'Tags',
                'mapped' => false,
                'required' => false,
                'attr' => array('class' => 'tagManager', 'placeholder' => 'Tags', 'name' => 'tags', 'data-provide' => 'typeahead'))
            )
            ->add('tagList', 'hidden', array(
                'mapped' => false
            ))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Virgule\Bundle\MainBundle\Entity\Document'
    ));
  }

  public function getName() {
    return 'document';
  }

}
