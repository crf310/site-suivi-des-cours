<?php

/**
 * Description of Schedule
 *
 * @author guillaume
 */
class Schedule {
    private $schedule;
    private $days = Array(1,2,3,4,5);
    
    private $startTime;
    
    private $endTime;
    
    private $step;
    
    public function __construct() {
        
    }
    
    private function initArray() {
        $this->schedule = Array();
    }
}

?>
