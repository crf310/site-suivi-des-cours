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
     * @ORM\OneToMany(targetEntity="Attachment", mappedBy="classSession")
     */
    private $attachments;

   /**
     * @ORM\ManyToMany(targetEntity="Student")
     * @ORM\JoinTable(name="student_classsession")
     */
    private $students;
    
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
     * Constructor
     */
    public function __construct() {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \Virgule\Bundle\MainBundle\Entity\Attachment $attachments
     * @return ClassSession
     */
    public function addAttachment(\Virgule\Bundle\MainBundle\Entity\Attachment $attachments) {
        $this->attachments[] = $attachments;

        return $this;
    }

    /**
     * Remove attachments
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Attachment $attachments
     */
    public function removeAttachment(\Virgule\Bundle\MainBundle\Entity\Attachment $attachments) {
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
    public function addStudent(\Virgule\Bundle\MainBundle\Entity\Student $students)
    {
        $this->students[] = $students;
    
        return $this;
    }

    /**
     * Remove students
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $students
     */
    public function removeStudent(\Virgule\Bundle\MainBundle\Entity\Student $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }
}