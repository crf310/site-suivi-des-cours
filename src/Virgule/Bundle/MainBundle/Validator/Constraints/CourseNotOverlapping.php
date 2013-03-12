<?php
namespace Virgule\Bundle\MainBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CourseNotOverlapping extends Constraint {

    public $message = 'Ce cours entre en conflit avec un autre le même jour et dans la même salle.';
    
    public function validatedBy() {
        //return get_class($this).'Validator';
        return 'course_not_overlapping';
    }
    
    public function getTargets() {
        return self::CLASS_CONSTRAINT;
    }
}

?>
