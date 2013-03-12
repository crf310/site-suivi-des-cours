<?php

namespace Virgule\Bundle\MainBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CourseNotOverlappingValidator extends ConstraintValidator {
    private $courseRepository;
    
    public function __construct($courseRepository) {
        $this->courseRepository = $courseRepository;
    }
    
    public function validate($value, Constraint $constraint) {        
        $nbCours = $this->courseRepository->getNumberOfOverlappingCourses($value);
        
        if ($nbCours > 0) {
            $this->context->addViolation($constraint->message, array('%nb_cours%' => (string)$nbCours));
        }
    }
}

?>
