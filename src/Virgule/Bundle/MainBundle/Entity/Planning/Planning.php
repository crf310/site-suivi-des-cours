<?php
namespace Virgule\Bundle\MainBundle\Entity\Planning;

use Virgule\Bundle\MainBundle\Entity\Planning\HeaderCell;
use Virgule\Bundle\MainBundle\Entity\Planning\PlanningCell;
use Virgule\Bundle\MainBundle\Entity\CourseHydrated;

class Planning {
    // cells[jour][heure_debut]
    
    private $dayStart;  
    private $dayEnd;
    private $startTime;
    private $endTime;
    
    public static $cellSize = 30;
    
    private $header = Array();
    private $rows = Array();
    
    private $classRooms = Array();
    
    public function __construct($courses) {  
        $this->dayStart = 1;
        $this->dayEnd = 6;
        $this->startTime = new \DateTime('08:00');
        $this->endTime = new \DateTime('21:30');
        
        $this->initPlanning($courses);
        $this->initHeader();
        $this->addCourses($courses);
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
            foreach ($this->classRooms as $classRoomId => $classRoomName) {
                $this->header[$day]->addClassRoom($classRoomId, $classRoomName);
            }
        }
    }
    
    private function initPlanning($courses) {        
        $startTimeCell = clone $this->startTime;
        $endTimeCell = clone $this->startTime; 
        $endTimeCell->modify("+" . self::$cellSize . " minutes");
        
        foreach ($courses as $course) {
            $this->storeClassRoom($course->getClassRoomId(), $course->getClassRoomName());
        }
        
        if (count($this->classRooms) == 0) {
            $this->storeClassRoom(0, "");
        }
        
        while ($startTimeCell <= $this->endTime) {           
            $timeIndex = $startTimeCell->format('H:i');
            
            $this->rows[$timeIndex] = new PlanningRow($startTimeCell->format('H:i'), $endTimeCell->format('H:i'));
            
            for ($day = $this->dayStart; $day <= $this->dayEnd; $day++) {
                foreach ($this->classRooms as $classRoomId => $classRoomName) {
                    $this->rows[$timeIndex]->initCell($day, $classRoomId);
                }
            }
            $startTimeCell->modify("+" . self::$cellSize . " minutes");
            $endTimeCell->modify("+" . self::$cellSize . " minutes");
        }
    }
    
    private function addCourses($courses) {
        foreach($courses as $course) {
            $this->addCourse($course);
        }
    }
    private function addCourse(CourseHydrated $course) {
        $t = $course->getStartTime();
        $this->rows[$t->format('H:i')]->addCell($course);
        $timeCell = clone $course->getStartTime();
        $timeCell->modify("+" . self::$cellSize . " minutes");
                
        while ($timeCell < $course->getEndTime()) {      
            $timeIndex = $timeCell->format('H:i');
            $this->rows[$timeIndex]->removeCell($course->getDayOfWeek(), $course->getClassRoomId());
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
    
    private function storeClassRoom($classRoomId, $classRoomLabel) {
        if (! array_key_exists($classRoomId, $this->classRooms)) {
            $this->classRooms[$classRoomId] = $classRoomLabel;
        }
    }
}
?>
