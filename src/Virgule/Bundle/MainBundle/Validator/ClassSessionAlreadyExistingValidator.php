<?php

namespace Virgule\Bundle\MainBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ClassSessionAlreadyExistingValidator extends ConstraintValidator {

    private $classSessionManager;

    public function __construct($classSessionManager) {
        $this->classSessionManager = $classSessionManager;
    }

    public function validate($classSession, Constraint $constraint) {

        $nbCours = $this->classSessionManager->isClassSessionAlreadyExisting($classSession);

        if ($nbCours > 0) {
            $this->context->addViolation($constraint->message, array('%nb_cours%' => (string) $nbCours));
        }
    }
}

?>
