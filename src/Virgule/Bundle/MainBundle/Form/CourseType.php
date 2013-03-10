<?php

namespace Virgule\Bundle\MainBundle\Form;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Virgule\Bundle\MainBundle\Repository\TeacherRepository;

class CourseType extends AbstractType {

    private $organizationBranchId;
    private $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository, $organizationBranchId) {
        $this->teacherRepository = $teacherRepository;
        $this->organizationBranchId = $organizationBranchId;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dayOfWeek', 'choice', array(
                    'expanded' => false,
                    'choices' => array('1' => 'Lundi', 'Mardi', 'Mercredi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'),
                    'data' => '1',
                    'attr' => array('class' => 'tiny-select'),
                ))
                ->add('startTime')
                ->add('endTime')
                ->add('alternateStartdate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker','data-date-format' => 'dd/mm/yyyy'),
                    'required'  => false
                ))
                ->add('alternateEnddate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker','data-date-format' => 'dd/mm/yyyy'),
                    'required'  => false
                ))             
                ->add('classLevel', 'entity', array(
                    'class' => 'VirguleMainBundle:ClassLevel',
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'label',
                    'property_path' => 'classlevel',            
                    'attr' => array('class' => 'tiny-select')
                 ))
                ->add('teachers', 'entity', array(
                    'class' => 'VirguleMainBundle:Teacher',
                    'query_builder' =>  $this->teacherRepository->getAvailableTeachersQueryBuilder($this->organizationBranchId, true),
                    'expanded' => false,
                    'multiple' => true,
                    'property' => 'fullname',
                    'property_path' => 'teachers',            
                    'attr' => array('class' => 'big-select')
                ))
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
