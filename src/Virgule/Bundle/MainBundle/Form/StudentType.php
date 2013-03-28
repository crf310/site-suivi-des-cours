<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Virgule\Bundle\MainBundle\Repository\TeacherRepository;
use Virgule\Bundle\MainBundle\Repository\CountryRepository;

class StudentType extends AbstractType {

    private $teacherRepository;
    
    private $countryRepository;
        
    private $openHousesDates;
    
    public function __construct(TeacherRepository $teacherRepository = null, CountryRepository $countryRepository = null, $organizationBranchId = null, $openHousesDates = null) {
        $this->teacherRepository = $teacherRepository;
        $this->countryRepository = $countryRepository;
        $this->organizationBranchId = $organizationBranchId;
        $this->openHousesDates = $openHousesDates;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                //->add('registrationDate')
                ->add('lastname')
                ->add('firstname')
                ->add('birthdate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker','data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('nationality')
                ->add('nationality', 'entity', array(
                    'class' => 'VirguleMainBundle:Country',
                    'query_builder' =>  $this->countryRepository->loadAllQueryBuilder(),
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'label',
                    'property_path' => 'nationality',            
                    'attr' => array('class' => 'medium-select')
                ))
                ->add('registrationDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'open_houses_dates' => $this->openHousesDates,
                    'attr' => array('class' => 'datepicker','data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('welcomedByTeacher', 'entity', array(
                    'class' => 'VirguleMainBundle:Teacher',
                    'query_builder' =>  $this->teacherRepository->getAvailableTeachersQueryBuilder($this->organizationBranchId, true),
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'fullname',
                    'property_path' => 'welcomedByTeacher',            
                    'attr' => array('class' => 'medium-select')
                ))
                
                                            
        /*
          ->add('phoneNumber')
          ->add('cellphoneNumber')
          ->add('address')
          ->add('zipcode')
          ->add('city')
          ->add('gender')
          ->add('nationality')
          ->add('maritalStatus')
          ->add('picturePath')
          ->add('arrivalDate')
          ->add('scholarized')
          ->add('profession')
          ->add('scholarizedInTheCountry')
          ->add('scholarizedInAForeignCountry')
          ->add('scholarizationLevel')
          ->add('emergencyContactLastname')
          ->add('emergencyContactFirstname')
          ->add('emergencyContactPhoneNumber')
          ->add('emergencyContactConnectionType') */
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
