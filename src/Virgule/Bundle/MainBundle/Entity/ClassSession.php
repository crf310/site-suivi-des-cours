<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\ClassSession
 *
 * @ORM\Table(name="class_session")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\ClassSessionRepository")
 */
class ClassSession {

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
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="classSessions")
     * @ORM\JoinColumn(name="fk_course", referencedColumnName="id")
     */
    private $course;

    /**
     * Teacher who actually managed the class
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="classSessionsDriven")
     * @ORM\JoinColumn(name="fk_session_teacher", referencedColumnName="id")
     */
    private $sessionTeacher;

    /**
     * Teacher who posted the report
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="classSessionsReported")
     * @ORM\JoinColumn(name="fk_report_teacher", referencedColumnName="id")
     */
    private $reportTeacher;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="classSession")
     */
    private $comments;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ClassSession
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return ClassSession
     */
    public function setSummary($summary) {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary() {
        return $this->summary;
    }

    /**
     * Set fkClassId
     *
     * @param integer $fkClassId
     * @return ClassSession
     */
    public function setFkClassId($fkClassId) {
        $this->fkClassId = $fkClassId;

        return $this;
    }

    /**
     * Get fkClassId
     *
     * @return integer 
     */
    public function getFkClassId() {
        return $this->fkClassId;
    }

    /**
     * Set fkSessionTeacherId
     *
     * @param integer $fkSessionTeacherId
     * @return ClassSession
     */
    public function setFkSessionTeacherId($fkSessionTeacherId) {
        $this->fkSessionTeacherId = $fkSessionTeacherId;

        return $this;
    }

    /**
     * Get fkSessionTeacherId
     *
     * @return integer 
     */
    public function getFkSessionTeacherId() {
        return $this->fkSessionTeacherId;
    }

    /**
     * Set fkSummaryTeacherId
     *
     * @param integer $fkSummaryTeacherId
     * @return ClassSession
     */
    public function setFkSummaryTeacherId($fkSummaryTeacherId) {
        $this->fkSummaryTeacherId = $fkSummaryTeacherId;

        return $this;
    }

    /**
     * Get fkSummaryTeacherId
     *
     * @return integer 
     */
    public function getFkSummaryTeacherId() {
        return $this->fkSummaryTeacherId;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set course
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Course $course
     * @return ClassSession
     */
    public function setCourse(\Virgule\Bundle\MainBundle\Entity\Course $course = null)
    {
        $this->course = $course;
    
        return $this;
    }

    /**
     * Get course
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set sessionTeacher
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $sessionTeacher
     * @return ClassSession
     */
    public function setSessionTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $sessionTeacher = null)
    {
        $this->sessionTeacher = $sessionTeacher;
    
        return $this;
    }

    /**
     * Get sessionTeacher
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Teacher 
     */
    public function getSessionTeacher()
    {
        return $this->sessionTeacher;
    }

    /**
     * Set reportTeacher
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $reportTeacher
     * @return ClassSession
     */
    public function setReportTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $reportTeacher = null)
    {
        $this->reportTeacher = $reportTeacher;
    
        return $this;
    }

    /**
     * Get reportTeacher
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Teacher 
     */
    public function getReportTeacher()
    {
        return $this->reportTeacher;
    }

    /**
     * Add comments
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Comment $comments
     * @return ClassSession
     */
    public function addComment(\Virgule\Bundle\MainBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Comment $comments
     */
    public function removeComment(\Virgule\Bundle\MainBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}