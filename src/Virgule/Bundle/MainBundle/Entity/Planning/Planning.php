<?php
namespace Virgule\Bundle\MainBundle\Entity\Planning;

use Virgule\Bundle\MainBundle\Entity\Planning\HeaderCell;
use Virgule\Bundle\MainBundle\Entity\Planning\PlanningCell;
use Virgule\Bundle\MainBundle\Entity\Course;

class Planning {
    // cells[jour][heure_debut]
    
    private $dayStart;  
    private $dayEnd;
    private $startTime;
    private $endTime;
    
    public static $cellSize = 30;
    
    private $header = Array();
    private $rows = Array();
    
    private $totalClassRooms;
    
    public function __construct($courses, $totalClassRooms=2) {  
        $this->dayStart = 1;
        $this->dayEnd = 6;
        $this->startTime = new \DateTime('08:00');
        $this->endTime = new \DateTime('22:00');
        $this->totalClassRooms = $totalClassRooms;
        
        $this->initHeader();
        $this->initPlanning();
        foreach($courses as $course) {
            $this->addCourse($course);
        }
    }
    
    public function getRows() {
        return $this->rows;
    }
    
    public function getHeader() {
        return $this->header;
    }
    
    private function initHeader() {
        for ($day = $this->dayStart; $day <= $this->dayEnd; $day++) {
            $this->header[$day] = new HeaderCell($day);
            for ($classRoom = 1; $classRoom <= $this->totalClassRooms; $classRoom++) {
                $this->header[$day]->addClassRoom('Classroom #' . $classRoom);
            }
        }
    }
    
    private function initPlanning() {        
        $startTimeCell = clone $this->startTime;
        $endTimeCell = clone $this->startTime; 
        $endTimeCell->modify("+" . self::$cellSize . " minutes");
            
        while ($startTimeCell <= $this->endTime) {           
            $timeIndex = $startTimeCell->format('H:i');
            
            $this->rows[$timeIndex] = new PlanningRow($startTimeCell->format('H:i'), $endTimeCell->format('H:i'));
            
            for ($day = $this->dayStart; $day <= $this->dayEnd; $day++) {
                for ($classRoom = 1; $classRoom <= $this->totalClassRooms; $classRoom++) {
                    $this->rows[$timeIndex]->initCell($day, $classRoom);
                }
            }
            $startTimeCell->modify("+" . self::$cellSize . " minutes");
            $endTimeCell->modify("+" . self::$cellSize . " minutes");
        }
    }
    
    private function addCourse(Course $course) {
        echo '<br />';
        echo 'Course #'.$course->getId();
        $t = $course->getStartTime();
        $this->rows[$t->format('H:i')]->addCell($course);
        $timeCell = clone $course->getStartTime();
        $timeCell->modify("+" . self::$cellSize . " minutes");
        
        while ($timeCell <= $this->endTime) {      
            $timeIndex = $timeCell->format('H:i');
            $this->rows[$timeIndex]->removeCell($course->getDayOfWeek(), $course->getClassRoom()->getId());
            $timeCell->modify("+" . self::$cellSize . " minutes");
        }        
    }
}
?>
