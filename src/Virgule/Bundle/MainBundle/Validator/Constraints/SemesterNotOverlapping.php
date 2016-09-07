<?php

namespace Virgule\Bundle\MainBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SemesterNotOverlapping extends Constraint {

  public $message = 'Un semestre n\'est pas terminé au %start_date%';

  public function validatedBy() {
    return 'semester_not_overlapping';
  }

  public function getTargets() {
    return self::CLASS_CONSTRAINT;
  }

}

?>
