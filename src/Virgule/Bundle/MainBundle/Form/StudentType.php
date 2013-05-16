<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Virgule\Bundle\MainBundle\Repository\TeacherRepository;
use Virgule\Bundle\MainBundle\Repository\CountryRepository;
use Virgule\Bundle\MainBundle\Entity\Teacher;

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
                //->add('registrationDate')
                ->add('lastname')
                ->add('firstname')
                ->add('birthdate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('nativeCountry', 'country', array(
                    'attr' => array('class' => 'medium-select')
                ))
                ->add('registrationDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'open_houses_dates' => $this->openHousesDates,
                    'attr' => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('welcomedByTeacher', 'entity', array(
                    'class' => 'VirguleMainBundle:Teacher',
                    'query_builder' => $this->teacherRepository->getAvailableTeachersQueryBuilder($this->organizationBranchId, true),
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'fullname',
                    'property_path' => 'welcomedByTeacher',
                    'preferred_choices' => array($this->currentTeacher),
                    'attr' => array('class' => 'medium-select')
                ))
                ->add('phoneNumber')
                ->add('cellphoneNumber')
                ->add('address')
                ->add('zipcode')
                ->add('city')
                ->add('gender', 'choice', array(
                    'choices' => array('M' => 'Masculin', 'F' => 'Féminin'),
                    'expanded' => false,
                    'multiple' => false,
                ))
                ->add('picturePath', 'file')
                ->add('arrivalDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('emergencyContactLastname')
                ->add('emergencyContactFirstname')
                ->add('emergencyContactPhoneNumber')
                ->add('emergencyContactConnectionType')
                ->add('suggestedClassLevel', 'entity', array(
                    'class' => 'VirguleMainBundle:ClassLevel',
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'label',         
                    'attr' => array('class' => 'small-select')
                 ))
                ->add('courses', 'entity', array(
                    'class' => 'VirguleMainBundle:Course',
                    'expanded' => false,
                    'multiple' => true,        
                    'attr' => array('class' => 'medium-select')
                 ));
                
                /*
                 * 
                ->add('maritalStatus')
                ->add('scholarized')
                ->add('profession')
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
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_studenttype';
    }

}
