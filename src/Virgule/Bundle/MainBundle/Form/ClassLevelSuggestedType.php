<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

use Virgule\Bundle\MainBundle\Form\DataTransformer\StudentToNumberTransformer;

class ClassLevelSuggestedType extends AbstractType {

    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('classLevel', 'entity', array(
            'class'             => 'VirguleMainBundle:ClassLevel',
            'expanded'          => true,
            'multiple'          => false,            
            'cols_number'       => 6,
            'property'          => 'label',
            'property_path'     => 'classlevel',
            'label'             => false
            ));
        
        $transformer = new StudentToNumberTransformer($this->em);
        
        $builder->add(
            $builder->create('student', 'hidden')->addModelTransformer($transformer)
        );
        
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassLevelSuggested'
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_classlevelsuggestedtype';
    }

}
