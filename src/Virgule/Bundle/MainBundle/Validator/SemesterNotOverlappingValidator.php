<?php

namespace Virgule\Bundle\MainBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SemesterNotOverlappingValidator extends ConstraintValidator {

  private $semesterManager;

  public function __construct($semesterManager) {
    $this->semesterManager = $semesterManager;
  }

  public function validate($semester, Constraint $constraint) {

    $nbSemesters = $this->semesterManager->getNumberOfSemesterNotFinishedAtStartDate($semester);

    if ($nbSemesters > 0) {
      $this->context->addViolation($constraint->message, array('%start_date%' => $semester->getStartDate()->format('d/m/Y')));
    }
  }

}

?>
