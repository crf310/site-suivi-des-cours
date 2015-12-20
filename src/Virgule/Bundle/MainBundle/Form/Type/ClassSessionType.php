<?php

namespace Virgule\Bundle\MainBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Virgule\Bundle\MainBundle\Entity\Teacher;
use Virgule\Bundle\MainBundle\Form\EventListener\AddClassSessionStudentsFieldSubscriber;
use Virgule\Bundle\MainBundle\Form\DataTransformer\CourseToNumberTransformer;

class ClassSessionType extends AbstractType {

  private $em;
  private $organizationBranchId;
  private $currentTeacher;
  private $semesterId;

  public function __construct(EntityManager $em, $organizationBranchId = null, Teacher $currentTeacher = null, $semesterId) {
    $this->em = $em;
    $this->organizationBranchId = $organizationBranchId;
    $this->currentTeacher = $currentTeacher;
    $this->semesterId = $semesterId;
  }

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('sessionDate', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy')))
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
                'property_path' => 'documents',
                'required' => false,
                'attr' => array('class' => 'big-select')
    ));

    $transformer = new CourseToNumberTransformer($this->em);
    $builder->add(
            $builder->create('course', 'hidden')->addModelTransformer($transformer)
    );
    $subscriber = new AddClassSessionStudentsFieldSubscriber($builder->getFormFactory(), $this->semesterId);
    $builder->addEventSubscriber($subscriber);
  }

  private function getTeachers($organizationBranchId) {
    $qb = $this->em->getRepository('VirguleMainBundle:Teacher')->getTeachers($organizationBranchId);
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
