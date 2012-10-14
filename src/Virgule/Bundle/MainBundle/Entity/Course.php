<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity
 */
class Course
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean $dayOfWeek
     *
     * @ORM\Column(name="day_of_week", type="boolean", nullable=false)
     */
    private $dayOfWeek;

    /**
     * @var \DateTime $startTime
     *
     * @ORM\Column(name="start_time", type="time", nullable=false)
     */
    private $startTime;

    /**
     * @var \DateTime $endTime
     *
     * @ORM\Column(name="end_time", type="time", nullable=false)
     */
    private $endTime;

    /**
     * @var \DateTime $alternateStartdate
     *
     * @ORM\Column(name="alternate_startdate", type="date", nullable=true)
     */
    private $alternateStartdate;

    /**
     * @var \DateTime $alternateEnddate
     *
     * @ORM\Column(name="alternate_enddate", type="date", nullable=true)
     */
    private $alternateEnddate;

    /**
     * @var integer $fkLevelId
     *
     * @ORM\Column(name="fk_level_id", type="integer", nullable=false)
     */
    private $fkLevelId;

    /**
     * @var integer $fkSemesterId
     *
     * @ORM\Column(name="fk_semester_id", type="integer", nullable=false)
     */
    private $fkSemesterId;

    /**
     * @var integer $fkTeacherId
     *
     * @ORM\Column(name="fk_teacher_id", type="integer", nullable=false)
     */
    private $fkTeacherId;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dayOfWeek
     *
     * @param boolean $dayOfWeek
     * @return Course
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;
    
        return $this;
    }

    /**
     * Get dayOfWeek
     *
     * @return boolean 
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Course
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    
        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Course
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    
        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set alternateStartdate
     *
     * @param \DateTime $alternateStartdate
     * @return Course
     */
    public function setAlternateStartdate($alternateStartdate)
    {
        $this->alternateStartdate = $alternateStartdate;
    
        return $this;
    }

    /**
     * Get alternateStartdate
     *
     * @return \DateTime 
     */
    public function getAlternateStartdate()
    {
        return $this->alternateStartdate;
    }

    /**
     * Set alternateEnddate
     *
     * @param \DateTime $alternateEnddate
     * @return Course
     */
    public function setAlternateEnddate($alternateEnddate)
    {
        $this->alternateEnddate = $alternateEnddate;
    
        return $this;
    }

    /**
     * Get alternateEnddate
     *
     * @return \DateTime 
     */
    public function getAlternateEnddate()
    {
        return $this->alternateEnddate;
    }

    /**
     * Set fkLevelId
     *
     * @param integer $fkLevelId
     * @return Course
     */
    public function setFkLevelId($fkLevelId)
    {
        $this->fkLevelId = $fkLevelId;
    
        return $this;
    }

    /**
     * Get fkLevelId
     *
     * @return integer 
     */
    public function getFkLevelId()
    {
        return $this->fkLevelId;
    }

    /**
     * Set fkSemesterId
     *
     * @param integer $fkSemesterId
     * @return Course
     */
    public function setFkSemesterId($fkSemesterId)
    {
        $this->fkSemesterId = $fkSemesterId;
    
        return $this;
    }

    /**
     * Get fkSemesterId
     *
     * @return integer 
     */
    public function getFkSemesterId()
    {
        return $this->fkSemesterId;
    }

    /**
     * Set fkTeacherId
     *
     * @param integer $fkTeacherId
     * @return Course
     */
    public function setFkTeacherId($fkTeacherId)
    {
        $this->fkTeacherId = $fkTeacherId;
    
        return $this;
    }

    /**
     * Get fkTeacherId
     *
     * @return integer 
     */
    public function getFkTeacherId()
    {
        return $this->fkTeacherId;
    }
}