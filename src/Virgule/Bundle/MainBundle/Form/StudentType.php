<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Virgule\Bundle\MainBundle\Repository\TeacherRepository;
use Virgule\Bundle\MainBundle\Entity\Teacher;
use Virgule\Bundle\MainBundle\Form\Type\PictureType;

class StudentType extends AbstractType {

    private $teacherRepository;
    private $openHousesDates;
    private $currentTeacher;

    public function __construct(TeacherRepository $teacherRepository = null, $organizationBranchId = null, $openHousesDates = null, Teacher $currentTeacher = null) {
        $this->teacherRepository = $teacherRepository;
        $this->organizationBranchId = $organizationBranchId;
        $this->openHousesDates = $openHousesDates;
        $this->currentTeacher = $currentTeacher;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('file', new PictureType())
                ->add('lastname')
                ->add('firstname')
                ->add('birthdate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr'   => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('nativeCountry', 'country', array(
                    'attr' => array('class' => 'medium-select')
                ))
                ->add('spokenLanguages', 'entity', array(
                    'class'             => 'VirguleMainBundle:Language',
                    'expanded'          => false,
                    'multiple'          => true,
                    'property'          => 'name',
                    'attr'              => array('class' => 'medium-select')
                ))
                ->add('registrationDate', 'date', array(
                    'widget'            => 'single_text',
                    'format'            => 'dd/MM/yyyy',
                    'open_houses_dates' => $this->openHousesDates,
                    'attr'              => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('welcomedByTeacher', 'entity', array(
                    'class'             => 'VirguleMainBundle:Teacher',
                    'query_builder'     => $this->teacherRepository->getAvailableTeachersQueryBuilder($this->organizationBranchId, true),
                    'expanded'          => false,
                    'multiple'          => false,
                    'property'          => 'fullname',
                    'property_path'     => 'welcomedByTeacher',
                    'preferred_choices' => array($this->currentTeacher),
                    'attr'              => array('class' => 'medium-select')
                ))
                ->add('phoneNumber')
                ->add('cellphoneNumber')
                ->add('address')
                ->add('zipcode')
                ->add('city')
                ->add('gender', 'choice', array(
                    'choices'       => array('M' => 'Masculin', 'F' => 'Féminin'),
                    'expanded'      => true,
                    'multiple'      => false,
                    'cols_number'   => 2,                    
                    'data' => 'M'
                ))
                ->add('arrivalDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr'   => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy', 'required' => false)
                ))
                ->add('emergencyContactLastname')
                ->add('emergencyContactFirstname')
                ->add('emergencyContactPhoneNumber')
                ->add('emergencyContactConnectionType')
                ->add('suggestedClassLevel', 'collection', array(
                    'type'      => new ClassLevelSuggestedType($options['em']),
                    'allow_add' => true,
                    'prototype' => true,
                    'by_reference' => false,
                ))
                ->add('courses', 'entity', array(
                    'class'     => 'VirguleMainBundle:Course',
                    'expanded'  => false,
                    'multiple'  => true,        
                    'attr'      => array('class' => 'medium-select')
                 ))                
                ->add('profession')
                ;
        
        
                
                /*
                 * 
                ->add('maritalStatus')
                ->add('scholarized')
                ->add('scholarizedInTheCountry')
                ->add('scholarizedInAForeignCountry')
                ->add('scholarizationLevel')
                 */
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\Student'
        ));
        
        $resolver->setRequired(array(
            'em',
        ));

        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_studenttype';
    }

}
