<?php
namespace Virgule\Bundle\MainBundle\Entity\Planning;

use Virgule\Bundle\MainBundle\Entity\Course;
use Virgule\Bundle\MainBundle\Entity\Planning\PlanningCell;

class PlanningRow {
    private $startTime;
    private $endTime;
    
    private $cells = Array();
    
    public function __construct($startTime, $endTime) {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }
    
    public function getStartTime() {
        return $this->startTime;
    }
    
    public function getEndTime() {
        return $this->endTime;
    }
    
    public function getCells() {
        return $this->cells;
    }
    
    public function initCell($day, $classRoom) {
        $this->cells[$day][$classRoom] = new PlanningCell();
    }
            
    public function addCell(Course $course = null) {
        $this->cells[$course->getDayOfWeek()][$course->getClassRoom()->getId()] = new PlanningCell($course);
    }
    
    public function removeCell($day, $classRoom) {
        $this->cells[$day][$classRoom] = null;
    }
}
?>
