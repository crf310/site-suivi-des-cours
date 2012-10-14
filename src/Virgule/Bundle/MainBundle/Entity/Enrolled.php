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



    /**
     * Set fkStudentId
     *
     * @param integer $fkStudentId
     * @return Enrolled
     */
    public function setFkStudentId($fkStudentId)
    {
        $this->fkStudentId = $fkStudentId;
    
        return $this;
    }

    /**
     * Get fkStudentId
     *
     * @return integer 
     */
    public function getFkStudentId()
    {
        return $this->fkStudentId;
    }

    /**
     * Set fkCourseId
     *
     * @param integer $fkCourseId
     * @return Enrolled
     */
    public function setFkCourseId($fkCourseId)
    {
        $this->fkCourseId = $fkCourseId;
    
        return $this;
    }

    /**
     * Get fkCourseId
     *
     * @return integer 
     */
    public function getFkCourseId()
    {
        return $this->fkCourseId;
    }
}