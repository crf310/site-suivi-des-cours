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
            FormEvents::PRE_BIND => 'preBind',
            FormEvents::PRE_SET_DATA => 'preSetData',
        );
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
        $this->customizeForm($form, $courseId);
    }

    public function preBind(FormEvent $event) {
        $data = $event->getData();
        $course = $data['course'];
        $form = $event->getForm();

        $this->customizeForm($form, $course);
    }

    protected function customizeForm($form, $courseId) {
        if ($courseId) {
            $field = $this->factory->createNamed('classSessionStudents', 'entity', new ArrayCollection(), array(
                'class' => 'VirguleMainBundle:Student',
                'query_builder' => function(EntityRepository $er) use ($courseId) {
                    return $er->createQueryBuilder('s')
                                    ->add('orderBy', 's.lastname ASC, s.firstname ASC')
                                    ->innerJoin('s.courses', 'c2', 'WITH', 'c2.id = :courseId')
                                    ->setParameter('courseId', $courseId);
                },
                'expanded' => true,
                'multiple' => true,
                'property_path' => 'classSessionStudents',
                'property' => 'fullname',
                'cols_number' => 3,
            ));
            $form->add($field);
                    
            $form->add('course', 'hidden', array(
                'data' => $courseId,
                'mapped' => false))
            ;
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
                'expanded' => false,
                'multiple' => false,
                'property_path' => 'course',
                'attr' => array('class' => 'medium-select')
            ));
            $form->add($field);
        }
    }

}