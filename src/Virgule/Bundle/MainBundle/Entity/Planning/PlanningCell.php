<?php
namespace Virgule\Bundle\MainBundle\Entity\Planning;

use Virgule\Bundle\MainBundle\Entity\CourseHydrated;

class PlanningCell {
    
    private $course;
    
    private $content = '&nbsp;';
    
    private $rowspan = 0;
    
    public function __construct(CourseHydrated $course = null) {
        $this->course = $course;
        
        if ($course != null) {
            $this->rowspan = $this->calculateRowspan($course->getStartTime(), $course->getEndTime());
            $this->course = $course;
        }
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getCourse() {
        return $this->course;
    }
    
    public function hasCourse() {
        if ($this->course == null) {
            return false;
        } else {
            return true;
        }
    }
    public function getRowspan() {
        return $this->rowspan;
    }
    
    private function calculateRowspan($startTime, $endTime) {
        $t1 = strtotime($startTime->format('H:i'));
        $t2 = strtotime($endTime->format('H:i'));
        $minutes = ($t2 - $t1)/60; 
        $rowspan = $minutes / Planning::$cellSize;
        return $rowspan;
    }
}
?>
