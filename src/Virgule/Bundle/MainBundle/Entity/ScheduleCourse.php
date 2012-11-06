<?php

namespace Virgule\Bundle\MainBundle\Entity;

/**
 * Description of ScheduleCourse
 *
 * @author Guillaume Lucazeau
 */
class ScheduleCourse {
    private $course;
    
    function __construct($course) {
        $this->$course = $course;
    }
}

?>
