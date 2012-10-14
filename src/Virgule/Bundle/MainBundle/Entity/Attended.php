<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Attended
 *
 * @ORM\Table(name="attended")
 * @ORM\Entity
 */
class Attended
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
     * @var integer $fkSessionId
     *
     * @ORM\Column(name="fk_session_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkSessionId;



    /**
     * Set fkStudentId
     *
     * @param integer $fkStudentId
     * @return Attended
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
     * Set fkSessionId
     *
     * @param integer $fkSessionId
     * @return Attended
     */
    public function setFkSessionId($fkSessionId)
    {
        $this->fkSessionId = $fkSessionId;
    
        return $this;
    }

    /**
     * Get fkSessionId
     *
     * @return integer 
     */
    public function getFkSessionId()
    {
        return $this->fkSessionId;
    }
}