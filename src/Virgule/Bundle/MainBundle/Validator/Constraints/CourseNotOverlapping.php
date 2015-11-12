<?php

namespace Virgule\Bundle\MainBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CourseNotOverlapping extends Constraint {

  public $message = 'Ce cours entre en conflit avec %nb_cours%  autre(s) le même jour et dans la même salle';

  public function validatedBy() {
    return 'course_not_overlapping';
  }

  public function getTargets() {
    return self::CLASS_CONSTRAINT;
  }

}

?>
