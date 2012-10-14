<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Enrolled
 *
 * @ORM\Table(name="enrolled")
 * @ORM\Entity
 */
class Enrolled
{
    /**
     * @var integer $fkStudentId
     *
     * @ORM\Column(name="fk_student_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkStudentId;

    /**
     * @var integer $fkCourseId
     *
     * @ORM\Column(name="fk_course_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkCourseId;


}
