<?php

namespace Virgule\Bundle\MainBundle\Entity;

class CourseHydrated {

  private $courseId;
  private $dayOfWeek;
  private $startTime;
  private $endTime;
  private $alternateStartdate;
  private $alternateEnddate;
  private $classLevelId;
  private $classLevelLabel;
  private $classLevelColorCode;
  private $teachers = Array();
  private $classRoomId;
  private $classRoomName;
  private $nbStudents;

  public function __construct($id, $dayOfWeek, $startTime, $endTime, $alternateStartdate, $alternateEnddate, $nbStudents, $classLevelId, $classLevelLabel, $classLevelColorCode, $teachers, $classRoomId, $classRoomName) {
    $this->courseId = $id;
    $this->dayOfWeek = $dayOfWeek;
    $this->startTime = $startTime;
    $this->endTime = $endTime;
    $this->alternateStartdate = $alternateStartdate;
    $this->alternateEnddate = $alternateEnddate;
    $this->classLevelId = $classLevelId;
    $this->classLevelLabel = $classLevelLabel;
    $this->classLevelColorCode = $classLevelColorCode;
    $this->teachers = $teachers;
    $this->classRoomId = $classRoomId;
    $this->classRoomName = $classRoomName;
    $this->nbStudents = $nbStudents;
  }

  public function getId() {
    return $this->courseId;
  }

  public function getDayOfWeek() {
    return $this->dayOfWeek;
  }

  public function getStartTime() {
    return $this->startTime;
  }

  public function getEndTime() {
    return $this->endTime;
  }

  public function getAlternateStartdate() {
    return $this->alternateStartdate;
  }

  public function getAlternateEnddate() {
    return $this->alternateEnddate;
  }

  public function getClassLevelId() {
    return $this->classLevelId;
  }

  public function getClassLevelLabel() {
    return $this->classLevelLabel;
  }

  public function getClassLevelColorCode() {
    return $this->classLevelColorCode;
  }

  public function getTeachers() {
    return $this->teachers;
  }

  public function getClassRoomId() {
    return $this->classRoomId;
  }

  public function getClassRoomName() {
    return $this->classRoomName;
  }

  public function getNbStudents() {
    return $this->nbStudents;
  }

  /**
   * Returns false if alternateStartDate is not null and in the future
   * Returns false if alternateEndDate is not null and in the past
   * @return boolean
   */
  public function isCurrent() {
    $isCurrent = true;
    $today = new \DateTime('now');

    if ($this->getAlternateStartdate() != null && $today < $this->getAlternateStartdate()) {
      $isCurrent = false;
    }
    if ($this->getAlternateEnddate() != null && $today > $this->getAlternateEnddate()) {
      $isCurrent = false;
    }
    return $isCurrent;
  }

}

?>
