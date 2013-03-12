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
        $nbCourses = $this->courseRepository->getNumberOfOverlappingCourses($value);
        if ($nbCourses > 0) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}

?>
