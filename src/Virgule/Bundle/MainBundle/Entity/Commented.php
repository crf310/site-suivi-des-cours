<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Commented
 *
 * @ORM\Table(name="commented")
 * @ORM\Entity
 */
class Commented
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
     * @var integer $fkTeacherId
     *
     * @ORM\Column(name="fk_teacher_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkTeacherId;



    /**
     * Set fkStudentId
     *
     * @param integer $fkStudentId
     * @return Commented
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
     * Set fkTeacherId
     *
     * @param integer $fkTeacherId
     * @return Commented
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