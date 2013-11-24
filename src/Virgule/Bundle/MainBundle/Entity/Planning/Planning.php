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
    
    private $hasClass = Array();
    
    private $displayOnlyCurrent;
    
    public function __construct($courses, $displayOnlyCurrent = false) {  
        $this->dayStart = 1;
        $this->dayEnd = 6;
        $this->startTime = new \DateTime('08:00');
        $this->endTime = new \DateTime('21:30');
        $this->displayOnlyCurrent = $displayOnlyCurrent;
        
        $this->initPlanning($courses);
        // header is initialized after because we know the classrooms from the courses
        $this->initHeader(); 
        $this->addCourses($courses);
        $this->removeRoomColsWithoutClass();
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
                
        // this array will store boolean to know if a class has at least one class for each day
        for ($day = $this->dayStart; $day <= $this->dayEnd; $day++) {
            foreach ($this->classRooms as $classRoomId => $classRoomName) {
                $this->hasClass[$day][$classRoomId] = false;
            }
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
            if (!$this->displayOnlyCurrent || ($this->displayOnlyCurrent && $course->isCurrent())) {
                $this->addCourse($course);
            }
        }
    }
    private function addCourse(CourseHydrated $course) {
        $t = $course->getStartTime();
        if (array_key_exists($t->format('H:i'), $this->rows)) {
            $this->rows[$t->format('H:i')]->addCell($course);
            $timeCell = clone $course->getStartTime();
            $timeCell->modify("+" . self::$cellSize . " minutes");

            while ($timeCell < $course->getEndTime()) {      
                $timeIndex = $timeCell->format('H:i');
                $this->rows[$timeIndex]->removeCell($course->getDayOfWeek(), $course->getClassRoomId());
                $timeCell->modify("+" . self::$cellSize . " minutes");
            }
        }
        
        // store that this couple of day/room has at least a class
        $this->hasClass[$course->getDayOfWeek()][$course->getClassRoomId()] = true;
    }
    
    private function storeClassRoom($classRoomId, $classRoomLabel) {
        if (! array_key_exists($classRoomId, $this->classRooms)) {
            $this->classRooms[$classRoomId] = $classRoomLabel;
        }
    }
    
    private function removeRoomColsWithoutClass() {
        for ($day = $this->dayStart; $day <= $this->dayEnd; $day++) {
            $dayHasClass = false;
            foreach ($this->classRooms as $classRoomId => $classRoomName) {
                // if a classroom doesn't host any class this day
                if (! $this->hasClass[$day][$classRoomId]) {
                    //echo "No class for $day in $classRoomId\n";
                    $this->header[$day]->removeClassRoom($classRoomId);
                    
                    $startTimeCell = clone $this->startTime;
                    while ($startTimeCell <= $this->endTime) {           
                        $timeIndex = $startTimeCell->format('H:i');
            
                        $this->rows[$timeIndex]->removeCell($day, $classRoomId);
            
                        $startTimeCell->modify("+" . self::$cellSize . " minutes");
                    }
                } else {
                    $dayHasClass = true;
                }
            }
            
            if (! $dayHasClass) {
                unset($this->header[$day]);
            }
        }
    }
}
?>
