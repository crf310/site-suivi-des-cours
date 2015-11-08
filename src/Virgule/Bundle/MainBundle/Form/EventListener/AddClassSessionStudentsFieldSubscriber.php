<?php

namespace Virgule\Bundle\MainBundle\Form\EventListener;

use \Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddClassSessionStudentsFieldSubscriber implements EventSubscriberInterface {

    /**
     * @var FormFactoryInterface
     */
    private $factory;

    private $semesterId;
    
    /**
     * @param factory FormFactoryInterface
     */
    public function __construct(FormFactoryInterface $factory, $semesterId) {
        $this->factory = $factory;
        $this->semesterId = $semesterId;
    }

    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SET_DATA    => 'preSetData',
            FormEvents::PRE_SUBMIT      => 'preSubmit',
            FormEvents::SUBMIT          => 'submit',
        );
    }

    /**
     * @param \Symfony\Component\Form\FormEvent $event
     */
    public function submit(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();
    }
    /**
     * @param \Symfony\Component\Form\FormEvent $event
     */
    public function preSetData(FormEvent $event) {
        /** @var ClassSession $data */
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }
        
        $courseId = null;
        if (null !== $data->getCourse()) {
            $courseId = $data->getCourse()->getId();
        }        
        $selectedEnrolledStudents = new ArrayCollection();
        if (null !== $data->getClassSessionStudents()) {
            $selectedEnrolledStudents = $data->getClassSessionStudents();
        }
        $selectedNonEnrolledStudents = new ArrayCollection();
        if (null !== $data->getNonEnrolledClassSessionStudents()) {
            $selectedNonEnrolledStudents = $data->getNonEnrolledClassSessionStudents();
        }
        
        $this->customizeForm($form, $courseId, $selectedEnrolledStudents, $selectedNonEnrolledStudents);
    }

    public function preSubmit(FormEvent $event) {
        $data = $event->getData();
        $course = $data['course'];
        $form = $event->getForm();

        $selectedEnrolledStudents = new ArrayCollection();
        $selectedNonEnrolledStudents = new ArrayCollection();
        $this->customizeForm($form, $course, $selectedEnrolledStudents, $selectedNonEnrolledStudents);
    }

    protected function customizeForm($form, $courseId, $selectedEnrolledStudents, $selectedNonEnrolledStudents) {
        if ($courseId) {
            $enrolledStudentsField = $this->factory->createNamed('classSessionStudents', 'entity', $selectedEnrolledStudents, array(
                'class' => 'VirguleMainBundle:Student',
                'query_builder' => function(EntityRepository $er) use ($courseId) {
                    return $er->createQueryBuilder('s')
                                    ->add('orderBy', 's.lastname ASC, s.firstname ASC')
                                    ->innerJoin('s.courses', 'c2', 'WITH', 'c2.id = :courseId')
                                    ->setParameter('courseId', $courseId);
                },
                'expanded'          => true,
                'multiple'          => true,
                'property_path'     => 'classSessionStudents',
                'property'          => 'fullname',
                'cols_number'       => 3,
                'add_check_all'     => true,
                'auto_initialize'   => false,
                'required'          => false
            ));
            $form->add($enrolledStudentsField);
                
            $semesterId = $this->semesterId;
            $nonEnrolledStudentsField = $this->factory->createNamed('nonEnrolledStudentsField', 'entity', $selectedNonEnrolledStudents, array(
                'class'              => 'VirguleMainBundle:Student',
                'query_builder' => function(EntityRepository $er) use ($courseId, $semesterId) {
                    return $er->createQueryBuilder('s')
                                    ->add('orderBy', 's.lastname ASC, s.firstname ASC')
                                    ->innerJoin('s.courses', 'c', 'WITH', 'c.id != :courseId')
                                    ->innerJoin('c.semester', 'se', 'WITH', 'se.id = :semesterId')
                                    ->setParameter('courseId', $courseId)
                                    ->setParameter('semesterId', $semesterId);
                },
                'expanded'          => false,
                'multiple'          => true,
                'property_path'     => 'nonEnrolledClassSessionStudents',
                'property'          => 'fullname',
                'auto_initialize'   => false,
                'required'          => false,    
                'attr'              => array('class' => 'medium-select','required' => false)

            ));
            $form->add($nonEnrolledStudentsField);
        } else {
            $semesterId = $this->semesterId;
            
            $field = $this->factory->createNamed('course', 'entity', null, array(
                'class' => 'VirguleMainBundle:Course',
                'query_builder' => function(EntityRepository $er) use ($semesterId) {
                    return $er->createQueryBuilder('c')
                            ->innerJoin('c.semester', 's')
                            ->where('s.id = :semesterId')
                            ->add('orderBy', 'c.dayOfWeek ASC, c.startTime ASC')
                            ->setParameter('semesterId', $semesterId);
                },
                'auto_initialize' => false,
                'expanded' => false,
                'multiple' => false,
                'property_path' => 'course',
                'attr' => array('class' => 'medium-select')
            ));
            $form->add($field);
        }
    }

}
