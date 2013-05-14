<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Virgule\Bundle\MainBundle\Form\DataTransformer\StudentToNumberTransformer;

class ClassLevelSuggestedType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('classLevel', 'entity', array(
            'class' => 'VirguleMainBundle:ClassLevel',
            'expanded' => false,
            'multiple' => false,
            'property' => 'label',
            'property_path' => 'classlevel',
            'attr' => array('class' => 'tiny-select')
            ));
        
        $entityManager = $options['em'];
        $transformer = new StudentToNumberTransformer($entityManager);
        
        $builder->add(
            $builder->create('student', 'hidden')->addModelTransformer($transformer)
        );
        
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassLevelSuggested'
        ));
        
        $resolver->setRequired(array(
            'em',
        ));

        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_classlevelsuggestedtype';
    }

}
