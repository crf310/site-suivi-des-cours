<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Virgule\Bundle\MainBundle\Entity\ClassSession
 *
 * @ORM\Table(name="classsessions")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\ClassSessionRepository") * 
 * @UniqueEntity(fields={"course", "sessionDate"}, message="Un compte-rendu est déjà enregistré pour ce cours à cette date")
 *
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
     * @var \DateTime $reportDate
     *
     * @ORM\Column(name="report_date", type="datetime", nullable=false)
     */
    private $reportDate;

    /**
     * @var \Date $sessionDate
     *
     * @ORM\Column(name="session_date", type="date", nullable=false)
     */
    private $sessionDate;

    /**
     * @var string $summary
     *
     * @ORM\Column(name="summary", type="text", nullable=false)
     */
    private $summary;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="classSessions")
     * @ORM\JoinColumn(name="fk_course", referencedColumnName="id", nullable=false)
     */
    private $course;

    /**
     * Teacher who actually managed the class
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="classSessionsDriven")
     * @ORM\JoinColumn(name="fk_session_teacher", referencedColumnName="id", nullable=false)
     */
    private $sessionTeacher;

    /**
     * Teacher who posted the report
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="classSessionsReported")
     * @ORM\JoinColumn(name="fk_report_teacher", referencedColumnName="id", nullable=false)
     */
    private $reportTeacher;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="classSession")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Document", inversedBy="classSessions")     * 
     * @ORM\JoinTable(name="classsessions_documents")
     */
    private $documents;

    /**
     * @ORM\ManyToMany(targetEntity="Student", inversedBy="classSessions")
     * @ORM\JoinTable(name="classsessions_students")
     * @Assert\NotNull
     */
    protected $classSessionStudents;
    
    /**
     * @ORM\ManyToMany(targetEntity="Student", inversedBy="classSessionsNonEnrolled")
     * @ORM\JoinTable(name="classsessions_students_non_enrolled")
     */
    protected $nonEnrolledClassSessionStudents;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set Report date
     *
     * @param \DateTime $date
     * @return ClassSession
     */
    public function setReportDate($date) {
        $this->reportDate = $date;

        return $this;
    }

    /**
     * Get report date
     *
     * @return \DateTime 
     */
    public function getReportDate() {
        return $this->reportDate;
    }

    /**
     * Set Session date
     *
     * @param \DateTime $date
     * @return ClassSession
     */
    public function setSessionDate($date) {
        $this->sessionDate = $date;

        return $this;
    }

    /**
     * Get session date
     *
     * @return \DateTime 
     */
    public function getSessionDate() {
        return $this->sessionDate;
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
     * Constructor
     */
    public function __construct() {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->classSessionStudents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->nonEnrolledClassSessionStudents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set course
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Course $course
     * @return ClassSession
     */
    public function setCourse(\Virgule\Bundle\MainBundle\Entity\Course $course = null) {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Course 
     */
    public function getCourse() {
        return $this->course;
    }

    /**
     * Set sessionTeacher
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $sessionTeacher
     * @return ClassSession
     */
    public function setSessionTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $sessionTeacher = null) {
        $this->sessionTeacher = $sessionTeacher;

        return $this;
    }

    /**
     * Get sessionTeacher
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Teacher 
     */
    public function getSessionTeacher() {
        return $this->sessionTeacher;
    }

    /**
     * Set reportTeacher
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $reportTeacher
     * @return ClassSession
     */
    public function setReportTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $reportTeacher = null) {
        $this->reportTeacher = $reportTeacher;

        return $this;
    }

    /**
     * Get reportTeacher
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Teacher 
     */
    public function getReportTeacher() {
        return $this->reportTeacher;
    }

    /**
     * Add comments
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Comment $comments
     * @return ClassSession
     */
    public function addComment(\Virgule\Bundle\MainBundle\Entity\Comment $comments) {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Comment $comments
     */
    public function removeComment(\Virgule\Bundle\MainBundle\Entity\Comment $comments) {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments() {
        return $this->comments;
    }

    /**
     * Add attachments
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Document $attachments
     * @return ClassSession
     */
    public function addAttachment(\Virgule\Bundle\MainBundle\Entity\Document $attachments) {
        $this->attachments[] = $attachments;

        return $this;
    }

    /**
     * Remove attachments
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Document $attachments
     */
    public function removeAttachment(\Virgule\Bundle\MainBundle\Entity\Document $attachments) {
        $this->attachments->removeElement($attachments);
    }

    /**
     * Get attachments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttachments() {
        return $this->attachments;
    }

    /**
     * Add students
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $students
     * @return ClassSession
     */
    public function addClassSessionStudent(\Virgule\Bundle\MainBundle\Entity\Student $student) {
        $this->classSessionStudents[] = $student;        
        
        return $this;
    }
    
    /**
     * Remove students
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $students
     */
    public function removeClassSessionStudent(\Virgule\Bundle\MainBundle\Entity\Student $student) {
        $this->classSessionStudents->removeElement($student);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassSessionStudents() {
        return $this->classSessionStudents;
    }
    
    public function getNonEnrolledClassSessionStudents() {
        return $this->nonEnrolledClassSessionStudents;
    }
    
    /**
     * Add students
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $students
     * @return ClassSession
     */
    public function addNonEnrolledClassSessionStudent(\Virgule\Bundle\MainBundle\Entity\Student $student) {
        $this->nonEnrolledClassSessionStudents[] = $student;        
        
        return $this;
    }   
    
    /**
     * Remove students
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $students
     */
    public function removenonEnrolledClassSessionStudent(\Virgule\Bundle\MainBundle\Entity\Student $student) {
        $this->nonEnrolledClassSessionStudents->removeElement($student);
    }



    /**
     * Add documents
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Document $documents
     * @return ClassSession
     */
    public function addDocument(\Virgule\Bundle\MainBundle\Entity\Document $documents)
    {
        $this->documents[] = $documents;
    
        return $this;
    }

    /**
     * Remove documents
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Document $documents
     */
    public function removeDocument(\Virgule\Bundle\MainBundle\Entity\Document $documents)
    {
        $this->documents->removeElement($documents);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}