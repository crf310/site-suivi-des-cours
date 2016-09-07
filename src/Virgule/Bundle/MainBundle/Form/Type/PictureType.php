<?php

namespace Virgule\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PictureType extends AbstractType {

  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    
  }

  public function getParent() {
    return 'file';
  }

  public function getName() {
    return 'picture';
  }

}

?>
