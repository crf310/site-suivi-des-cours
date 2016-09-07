<?php

namespace Virgule\Bundle\MainBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CourseNotOverlappingValidator extends ConstraintValidator {

  private $courseManager;

  public function __construct($courseManager) {
    $this->courseManager = $courseManager;
  }

  public function validate($course, Constraint $constraint) {

    $nbCours = $this->courseManager->getNumberOfOverlappingCourses($course);

    if ($nbCours > 0) {
      $this->context->addViolation($constraint->message, array('%nb_cours%' => (string) $nbCours));
    }
  }

}

?>
