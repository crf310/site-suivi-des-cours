<?php

namespace Virgule\Bundle\MainBundle\Form;

use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
    
class ClassSessionType extends AbstractType {

    private $courseId;
    
    private $organizationBranchId;
    
    private $doctrine;

    public function __construct(RegistryInterface $doctrine, $courseId = null, $organizationBranchId = null) {
        $this->courseId = $courseId;
        $this->doctrine = $doctrine;
        $this->organizationBranchId = $organizationBranchId;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $now = new \DateTime('now');
        $sNow = $now->format('d/m/Y');
        $builder
                ->add('date', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date', 'value' => $sNow)))
                ->add('summary', 'ckeditor', array(
                    'config' => array(
                        'toolbar' => array(
                            array(
                                'name' => 'document',
                                'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                            ),
                            '/',
                            array(
                                'name' => 'basicstyles',
                                'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                            ),
                        ),
                        'ui_color' => '#ffffff'
                        )))
                ->add('students', 'entity', array(
                        'class' => 'VirguleMainBundle:Student', 
                        'query_builder' => $this->getStudents($this->courseId), 
                        'multiple' => true, 'expanded' => true))                
                ->add('sessionTeacher', 'entity', array(
                        'class' => 'VirguleMainBundle:Teacher', 
                        'query_builder' => $this->getTeachers($this->organizationBranchId),
                        'multiple' => false,
                        'expanded' => false,
                        'property_path' => 'sessionTeacher',
                        'attr' => array('class' => 'small-select')))
                ->add('course_id', 'hidden', array(
                    'data' => $this->courseId,
                    'mapped' => false
                ));
                ;
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
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassSession'
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_classsessiontype';
    }

}
