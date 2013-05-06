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

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param factory FormFactoryInterface
     */
    public function __construct(FormFactoryInterface $factory, EntityManager $em) {
        $this->factory = $factory;
        $this->em = $em;
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

        if (null === $data || null === $data->getCourse()) {
            return;
        }

        $courseId = $data->getCourse()->getId();
        $this->customizeForm($form, $courseId);
    }

    public function preBind(FormEvent $event) {
        $data = $event->getData();
        $courseId = $data['course_id'];
        $form = $event->getForm();

        $this->customizeForm($form, $courseId);
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
                'property' => 'fullname'
                    ));
            $form->add($field);
                    
            $form->add('course_id', 'hidden', array(
                'data' => $courseId,
                'mapped' => false))
            ;
        }
    }

}