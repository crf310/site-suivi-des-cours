<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Intl\Intl;
use Virgule\Bundle\MainBundle\Entity\Teacher;
use Virgule\Bundle\MainBundle\Form\Type\PictureType;
use Virgule\Bundle\MainBundle\Form\EventListener\PatchSubscriber;
use Virgule\Bundle\MainBundle\Form\EventListener\UpdateStudentCourseFieldSubscriber;
use Doctrine\ORM\EntityManager;

class StudentType extends AbstractType {

    private $em;
    private $intention;
    private $doctrine;
    private $openHousesDates;
    private $currentTeacher;
    private $semesterId;
    
    public function __construct($intention, EntityManager $em, RegistryInterface $doctrine, $organizationBranchId = null, $openHousesDates = null, Teacher $currentTeacher = null, $semesterId = null) {
        $this->intention = $intention;
        $this->doctrine = $doctrine;
        $this->organizationBranchId = $organizationBranchId;
        $this->openHousesDates = $openHousesDates;
        $this->currentTeacher = $currentTeacher;
        $this->semesterId = $semesterId;
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $countries = Intl::getRegionBundle()->getCountryNames();
        $countries['CN-54'] = "Tibet";
        setlocale(LC_COLLATE, 'fr_FR.utf8');
        asort($countries, SORT_LOCALE_STRING);
        
        $builder
                ->add('file', new PictureType(), array(
                    'required' => false
                ))
                ->add('lastname')
                ->add('firstname')
                ->add('birthdate', 'date', array(
                    'widget'    => 'single_text',
                    'format'    => 'dd/MM/yyyy',
                    'required'  => false,
                    'attr'      => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('nativeCountry', 'country', array(
                    'choices'   => $countries,
                    'attr'      => array('class' => 'medium-select')
                ))
                ->add('spokenLanguages', 'entity', array(
                    'class'             => 'VirguleMainBundle:Language',
                    'expanded'          => false,
                    'multiple'          => true,
                    'property'          => 'name',
                    'required'          => false,
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
                    'query_builder'     => $this->doctrine->getRepository('VirguleMainBundle:Teacher')->getAvailableTeachersQueryBuilder($this->organizationBranchId, true),
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
                    'cols_number'   => 2
                ))
                ->add('arrivalDate', 'date', array(
                    'widget'    => 'single_text',
                    'format'    => 'dd/MM/yyyy',
                    'required'  => false,
                    'attr'      => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy')
                ))
                ->add('emergencyContactLastname')
                ->add('emergencyContactFirstname')
                ->add('emergencyContactPhoneNumber')
                ->add('emergencyContactConnectionType')
                ->add('profession')
                ;
        
        if ($this->intention == 'create') {
            $builder->add('suggestedClassLevel', 'collection', array(
                    'type'      => new ClassLevelSuggestedType($options['em']),
                    'allow_add' => true,
                    'prototype' => true,
                    'by_reference' => false,
                ));
        }
               
        $subscriber = new PatchSubscriber();
        $builder->addEventSubscriber($subscriber);
        
        $coursesSubscriber = new UpdateStudentCourseFieldSubscriber($this->em, $this->doctrine, $this->semesterId);
        $builder->addEventSubscriber($coursesSubscriber);
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
