<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\CourseRepository")
 */
class Course {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="day_of_week", type="boolean", nullable=false)
     */
    private $dayOfWeek;

    /**
     * @var \Time
     *
     * @ORM\Column(name="start_time", type="time", nullable=false)
     */
    private $startTime;

    /**
     * @var \Time
     *
     * @ORM\Column(name="end_time", type="time", nullable=false)
     */
    private $endTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="alternate_startdate", type="date", nullable=true)
     */
    private $alternateStartdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="alternate_enddate", type="date", nullable=true)
     */
    private $alternateEnddate;

    /**
     * @ORM\ManyToOne(targetEntity="ClassLevel", inversedBy="courses")
     * @ORM\JoinColumn(name="fk_class_level", referencedColumnName="id")
     */
    private $classLevel;

    /**
     * @ORM\ManyToOne(targetEntity="Semester", inversedBy="courses")
     * @ORM\JoinColumn(name="fk_semester", referencedColumnName="id")
     */
    private $semester;

    /**
     * @ORM\ManyToMany(targetEntity="Teacher", cascade={"persist"})
     * @ORM\JoinTable(name="teacher_course")
     */
    private $teachers;

    /**
     * @ORM\ManyToOne(targetEntity="ClassRoom", inversedBy="courses")
     * @ORM\JoinColumn(name="fk_class_room", referencedColumnName="id")
     */
    protected $classRoom;

    /**
     * @ORM\ManyToOne(targetEntity="OrganizationBranch", inversedBy="courses")
     * @ORM\JoinColumn(name="fk_organization_branch", referencedColumnName="id")
     */
    private $organizationBranch;

    /**
     * @ORM\OneToMany(targetEntity="ClassSession", mappedBy="course")
     */
    private $classSessions;

    /**
     * @ORM\ManyToMany(targetEntity="Student", mappedBy="courses")
     * @ORM\JoinTable(name="student_courses")
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
     * Set dayOfWeek
     *
     * @param boolean $dayOfWeek
     * @return Course
     */
    public function setDayOfWeek($dayOfWeek) {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    /**
     * Get dayOfWeek
     *
     * @return boolean 
     */
    public function getDayOfWeek() {
        return $this->dayOfWeek;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Course
     */
    public function setStartTime($startTime) {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime() {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Course
     */
    public function setEndTime($endTime) {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime() {
        return $this->endTime;
    }

    /**
     * Set alternateStartdate
     *
     * @param \DateTime $alternateStartdate
     * @return Course
     */
    public function setAlternateStartdate($alternateStartdate) {
        $this->alternateStartdate = $alternateStartdate;

        return $this;
    }

    /**
     * Get alternateStartdate
     *
     * @return \DateTime 
     */
    public function getAlternateStartdate() {
        return $this->alternateStartdate;
    }

    /**
     * Set alternateEnddate
     *
     * @param \DateTime $alternateEnddate
     * @return Course
     */
    public function setAlternateEnddate($alternateEnddate) {
        $this->alternateEnddate = $alternateEnddate;

        return $this;
    }

    /**
     * Get alternateEnddate
     *
     * @return \DateTime 
     */
    public function getAlternateEnddate() {
        return $this->alternateEnddate;
    }

    /**
     * Set classLevel
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevel
     * @return Course
     */
    public function setClassLevel(\Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevel = null) {
        $this->classLevel = $classLevel;

        return $this;
    }

    /**
     * Get classLevel
     *
     * @return \Virgule\Bundle\MainBundle\Entity\ClassLevel 
     */
    public function getClassLevel() {
        return $this->classLevel;
    }

    /**
     * Set semester
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Semester $semester
     * @return Course
     */
    public function setSemester(\Virgule\Bundle\MainBundle\Entity\Semester $semester = null) {
        $this->semester = $semester;

        return $this;
    }

    /**
     * Get semester
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Semester 
     */
    public function getSemester() {
        return $this->semester;
    }

    /**
     * Set classRoom
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassRoom $classRoom
     * @return Course
     */
    public function setClassRoom(\Virgule\Bundle\MainBundle\Entity\ClassRoom $classRoom = null) {
        $this->classRoom = $classRoom;

        return $this;
    }

    /**
     * Get classRoom
     *
     * @return \Virgule\Bundle\MainBundle\Entity\ClassRoom 
     */
    public function getClassRoom() {
        return $this->classRoom;
    }

    /**
     * Set organizationBranch
     *
     * @param \Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranch
     * @return Course
     */
    public function setOrganizationBranch(\Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranch = null) {
        $this->organizationBranch = $organizationBranch;

        return $this;
    }

    /**
     * Get organizationBranch
     *
     * @return \Virgule\Bundle\MainBundle\Entity\OrganizationBranch 
     */
    public function getOrganizationBranch() {
        return $this->organizationBranch;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->classSessions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teachers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return 'Niveau ' . $this->classLevel . ', le ' . $this->dayOfWeek . ' de ' . $this->startTime->format('H:m') . ' à ' . $this->endTime->format('H:m');
    }

    /**
     * Add classSessions
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassSession $classSessions
     * @return Course
     */
    public function addClassSession(\Virgule\Bundle\MainBundle\Entity\ClassSession $classSessions) {
        $this->classSessions[] = $classSessions;

        return $this;
    }

    /**
     * Remove classSessions
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassSession $classSessions
     */
    public function removeClassSession(\Virgule\Bundle\MainBundle\Entity\ClassSession $classSessions) {
        $this->classSessions->removeElement($classSessions);
    }

    /**
     * Get classSessions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassSessions() {
        return $this->classSessions;
    }

    /**
     * Add students
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $students
     * @return Course
     */
    public function addStudent(\Virgule\Bundle\MainBundle\Entity\Student $students) {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $students
     */
    public function removeStudent(\Virgule\Bundle\MainBundle\Entity\Student $students) {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents() {
        return $this->students;
    }

    /**
     * Add teachers
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $teachers
     * @return Course
     */
    public function addTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $teacher) {
        $this->teachers[] = $teacher;

        return $this;
    }

    /**
     * Remove teachers
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $teachers
     */
    public function removeTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $teachers) {
        $this->teachers->removeElement($teachers);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeachers() {
        return $this->teachers;
    }

}