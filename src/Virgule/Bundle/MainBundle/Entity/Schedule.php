<?php

/**
 * Description of Schedule
 *
 * @author guillaume
 */
class Schedule {
    private $schedule;
    
    private $days = Array(1,2,3,4,5);
    
    private $rooms = Array('Room 1', 'Room 2');
    
    private $startTime;
    
    private $endTime;
    
    private $step;
    
    public function __construct() {
        
    }
    
    private function initArray() {
        $s = Array();
        
        foreach ($this->days as $day) {            
            foreach ($this->rooms as $room) {
                $t = $startTime;
                while ($t <= $endTime) {
                    $s[$day][$room][$t] = '<td>&nbsp;</td>';
                    $t += $step;
                }                
            }
        }
    }
}

?>
