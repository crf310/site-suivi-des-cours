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
                    'choices' => array('1' => 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'),
                    'data' => '1',
                    'attr' => array('class' => 'tiny-select'),
                ))
                ->add('startTime', 'time', array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'hours' => array(8,9,10,11,12,13,14,15,16,17,18,19,20,22),
                    'minutes' => array('00','15','30','45')
                ))
                ->add('endTime', 'time', array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'hours' => array(8,9,10,11,12,13,14,15,16,17,18,19,20,22),
                    'minutes' => array('00','15','30','45')
                ))
                ->add('classRoom', 'entity', array(
                    'class' => 'VirguleMainBundle:ClassRoom',
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'name',
                    'property_path' => 'classRoom',            
                    'attr' => array('class' => 'small-select')
                 ))
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
