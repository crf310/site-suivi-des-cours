<?php

namespace Virgule\Bundle\MainBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityManager;

class UpdateStudentCourseFieldSubscriber implements EventSubscriberInterface {

    private $em;
    
    private $semesterId;
    
    private $doctrine;
    
    public function __construct(EntityManager $em, RegistryInterface $doctrine, $semesterId) {
        $this->semesterId = $semesterId;
        $this->doctrine = $doctrine;
        $this->em = $em;
    }

    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SUBMIT => array('postSubmit', 1),
        );
    }

    public function preSetData(FormEvent $event) {
        // we get here the enrollment for the student that belong to a different semester than the one we're on.
        $data = $event->getData();
        $form = $event->getForm();
        $results = $this->doctrine->getRepository('VirguleMainBundle:Course')->getCoursesFromOtherSemesters($data->getId(), $this->semesterId);
        foreach($results as $course) {
            $otherCoursesIds[] = $course['id'];
        }
        $this->customizeForm($form, $otherCoursesIds);
    }
    
    
    public function postSubmit(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();
        
        // we put back classes that belong to a different semester than the one we're on
        $otherCoursesIds = $form->get("otherCourses")->getData();
        if ($otherCoursesIds != null) {
            $otherCoursesIds = explode(',', $otherCoursesIds);
            $otherCourses = $this->doctrine->getRepository('VirguleMainBundle:Course')->findBy(array('id' => $otherCoursesIds));

            foreach ($otherCourses as $course) {
                $data->addCourse($course);
            }
        }
        
        $event->setData($data);
    }
    
    
    protected function customizeForm($form, $otherCoursesIds) {
        $form->add('courses', 'entity', array(
            'class'     => 'VirguleMainBundle:Course',
            'query_builder' => $this->doctrine->getRepository('VirguleMainBundle:Course')->getCoursesForSemesterQB($this->semesterId),
            'group_by'      => 'classLevel.label',
            'expanded'  => false,
            'multiple'  => true,        
            'required'  => false,
            'attr'      => array('class' => 'medium-select')
         ));
        $form->add('otherCourses', 'hidden', array(
            'data'      => implode(',', $otherCoursesIds),
            'mapped'    => false
        ));
     
    }
}