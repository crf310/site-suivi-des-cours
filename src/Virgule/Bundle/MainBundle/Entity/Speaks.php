<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Speaks
 *
 * @ORM\Table(name="speaks")
 * @ORM\Entity
 */
class Speaks
{
    /**
     * @var integer $fkLanguageId
     *
     * @ORM\Column(name="fk_language_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkLanguageId;

    /**
     * @var integer $fkStudentId
     *
     * @ORM\Column(name="fk_student_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkStudentId;



    /**
     * Set fkLanguageId
     *
     * @param integer $fkLanguageId
     * @return Speaks
     */
    public function setFkLanguageId($fkLanguageId)
    {
        $this->fkLanguageId = $fkLanguageId;
    
        return $this;
    }

    /**
     * Get fkLanguageId
     *
     * @return integer 
     */
    public function getFkLanguageId()
    {
        return $this->fkLanguageId;
    }

    /**
     * Set fkStudentId
     *
     * @param integer $fkStudentId
     * @return Speaks
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
}
