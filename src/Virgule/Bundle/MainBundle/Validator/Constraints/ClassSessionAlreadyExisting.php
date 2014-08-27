<?php
namespace Virgule\Bundle\MainBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ClassSessionAlreadyExisting extends Constraint {

    public $message = 'Un compte rendu est déjà enregistré pour ce cours à cette date';
    
    public function validatedBy() {
        return 'classsession_already_existing';
    }
    
    public function getTargets() {
        return self::CLASS_CONSTRAINT;
    }
}

?>
