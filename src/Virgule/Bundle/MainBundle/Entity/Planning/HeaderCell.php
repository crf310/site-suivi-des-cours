<?php
namespace Virgule\Bundle\MainBundle\Entity\Planning;

class HeaderCell {
    private $day;
    
    private $classRooms = Array();
    
    public function __construct($day) {
        $this->day = $day;
    }
    
    public function getDay() {
        return $this->day;
    }
    
    public function getClassRooms() {
        return $this->classRooms;
    }
    
    public function addClassRoom($classRoomId, $classRoomName)  {
        $this->classRooms[$classRoomId] = $classRoomName;
    }
}
?>
