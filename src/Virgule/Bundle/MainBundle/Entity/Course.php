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


}
