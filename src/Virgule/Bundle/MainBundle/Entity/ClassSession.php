<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\ClassSession
 *
 * @ORM\Table(name="class_session")
 * @ORM\Entity
 */
class ClassSession
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
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string $summary
     *
     * @ORM\Column(name="summary", type="text", nullable=true)
     */
    private $summary;

    /**
     * @var integer $fkClassId
     *
     * @ORM\Column(name="fk_class_id", type="integer", nullable=false)
     */
    private $fkClassId;

    /**
     * @var integer $fkSessionTeacherId
     *
     * @ORM\Column(name="fk_session_teacher_id", type="integer", nullable=false)
     */
    private $fkSessionTeacherId;

    /**
     * @var integer $fkSummaryTeacherId
     *
     * @ORM\Column(name="fk_summary_teacher_id", type="integer", nullable=false)
     */
    private $fkSummaryTeacherId;



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
     * Set date
     *
     * @param \DateTime $date
     * @return ClassSession
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return ClassSession
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    
        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set fkClassId
     *
     * @param integer $fkClassId
     * @return ClassSession
     */
    public function setFkClassId($fkClassId)
    {
        $this->fkClassId = $fkClassId;
    
        return $this;
    }

    /**
     * Get fkClassId
     *
     * @return integer 
     */
    public function getFkClassId()
    {
        return $this->fkClassId;
    }

    /**
     * Set fkSessionTeacherId
     *
     * @param integer $fkSessionTeacherId
     * @return ClassSession
     */
    public function setFkSessionTeacherId($fkSessionTeacherId)
    {
        $this->fkSessionTeacherId = $fkSessionTeacherId;
    
        return $this;
    }

    /**
     * Get fkSessionTeacherId
     *
     * @return integer 
     */
    public function getFkSessionTeacherId()
    {
        return $this->fkSessionTeacherId;
    }

    /**
     * Set fkSummaryTeacherId
     *
     * @param integer $fkSummaryTeacherId
     * @return ClassSession
     */
    public function setFkSummaryTeacherId($fkSummaryTeacherId)
    {
        $this->fkSummaryTeacherId = $fkSummaryTeacherId;
    
        return $this;
    }

    /**
     * Get fkSummaryTeacherId
     *
     * @return integer 
     */
    public function getFkSummaryTeacherId()
    {
        return $this->fkSummaryTeacherId;
    }
}