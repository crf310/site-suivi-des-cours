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
    
    public function __construct($classRooms, $courses) {  
        $this->dayStart = 1;
        $this->dayEnd = 6;
        $this->startTime = new \DateTime('08:00');
        $this->endTime = new \DateTime('21:30');
        
        $this->classRooms = $classRooms;
        $this->totalClassRooms = count($classRooms);
        
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
            foreach ($this->classRooms as $classRoom) {
                $this->header[$day]->addClassRoom($classRoom['classroom_id'], $classRoom['classroom_name']);
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
                foreach ($this->classRooms as $classRoom) {
                    $this->rows[$timeIndex]->initCell($day, $classRoom['classroom_id']);
                }
            }
            $startTimeCell->modify("+" . self::$cellSize . " minutes");
            $endTimeCell->modify("+" . self::$cellSize . " minutes");
        }
    }
    
    private function addCourse(Course $course) {
        $t = $course->getStartTime();
        $this->rows[$t->format('H:i')]->addCell($course);
        $timeCell = clone $course->getStartTime();
        $timeCell->modify("+" . self::$cellSize . " minutes");
        
        while ($timeCell < $course->getEndTime()) {      
            $timeIndex = $timeCell->format('H:i');
            $this->rows[$timeIndex]->removeCell($course->getDayOfWeek(), $course->getClassRoom()->getId());
            $timeCell->modify("+" . self::$cellSize . " minutes");
        }        
    }
    
    private function sortCells() {
        foreach ($this->rows as $time => $row) {
            $this->rows[$time] = ksort($row->getCells());
            foreach ($row as $day => $cells) {
                $this->rows[$time][$day] = krsort($cells);
            }
        }
    }
}
?>
