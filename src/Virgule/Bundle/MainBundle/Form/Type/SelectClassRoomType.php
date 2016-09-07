<?php

namespace Virgule\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

class SelectClassRoomType extends AbstractType {

  private $em;
  private $organizationBranchId;

  public function __construct(EntityManager $em, $organizationBranchId) {
    $this->em = $em;
    $this->organizationBranchId = $organizationBranchId;
  }

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('classRoom', 'entity', array(
        'class' => 'VirguleMainBundle:ClassRoom',
        'expanded' => true,
        'multiple' => true,
        'cols_number' => 3,
        'property' => 'name',
        'property_path' => 'classroom',
        'label' => false,
        'query_builder' => $this->em->getRepository('VirguleMainBundle:ClassRoom')->getClassRoomsForOrganizationBranchQueryBuilder($this->organizationBranchId)
    ));
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassRoom'
    ));
  }

  public function getName() {
    return 'classRoomForm';
  }

}
