<?php

namespace Virgule\Bundle\MainBundle\Form;

use Doctrine\ORM\EntityManager;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Virgule\Bundle\MainBundle\Entity\Teacher;
use Virgule\Bundle\MainBundle\Form\EventListener\AddClassSessionStudentsFieldSubscriber;

class ClassSessionType extends AbstractType {
        
    private $doctrine;
    
    private $organizationBranchId;
        
    private $currentTeacher;

    private $semesterId;

    public function __construct(RegistryInterface $doctrine, $organizationBranchId = null, Teacher $currentTeacher = null, $semesterId) {
        $this->doctrine = $doctrine;
        $this->organizationBranchId = $organizationBranchId;
        $this->currentTeacher = $currentTeacher;
        $this->semesterId = $semesterId;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {    
        $now = new \DateTime('now');
        $sNow = $now->format('d/m/Y');
        
        $builder
                ->add('sessionDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy', 'value' => $sNow)))
                ->add('summary')          
                ->add('sessionTeacher', 'entity', array(
                        'class' => 'VirguleMainBundle:Teacher', 
                        'query_builder' => $this->getTeachers($this->organizationBranchId),
                        'multiple' => false,
                        'expanded' => false,
                        'property_path' => 'sessionTeacher',
                        'attr' => array('class' => 'small-select'),
                        'preferred_choices' => array($this->currentTeacher))
                    )                
                ->add('documents', 'entity', array(
                    'class' => 'VirguleMainBundle:Document',
                    'expanded' => false,
                    'multiple' => true,
                    'property' => 'fileName',
                    'property_path' => 'documents'
                ));
        
        $subscriber = new AddClassSessionStudentsFieldSubscriber($builder->getFormFactory(), $this->semesterId);
        $builder->addEventSubscriber($subscriber);
    }
    
    private function getTeachers($organizationBranchId) {
        $qb = $this->doctrine->getRepository('VirguleMainBundle:Teacher')->getAvailableTeachersQueryBuilder($organizationBranchId);
        return $qb;
    }
    
    private function getStudents($courseId) {
        $qb = $this->doctrine->getRepository('VirguleMainBundle:Student')->getQueryBuilderForStudentEnrolledInCourses(Array($courseId));
        return $qb;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassSession',
        ));
        
        
        $resolver->setRequired(array(
            'em',
        ));

        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_classsessiontype';
    }

}
