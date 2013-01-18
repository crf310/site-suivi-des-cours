<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Virgule\Bundle\MainBundle\Entity\Teacher
 *
 * @ORM\Table(name="teacher")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\TeacherRepository")
 */
class Teacher implements UserInterface, EquatableInterface {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    protected $isActive;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
     */
    protected $lastName;

    /**
     * @var string $firstName
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=false)
     */
    protected $firstName;

    /**
     * @var string $phoneNumber
     *
     * @ORM\Column(name="phone_number", type="string", length=10, nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var string $cellphoneNumber
     *
     * @ORM\Column(name="cellphone_number", type="string", length=10, nullable=true)
     */
    protected $cellphoneNumber;

    /**
     * @var string $emailAddress
     *
     * @ORM\Column(name="email_address", type="string", length=50, nullable=true)
     */
    protected $emailAddress;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    protected $username;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    protected $password;

    /**
     * @var \DateTime $registrationDate
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=false)
     */
    protected $registrationDate;

    /**
     * @var \DateTime $lastConnectionDate
     *
     * @ORM\Column(name="last_connection_date", type="datetime", nullable=true)
     */
    protected $lastConnectionDate;

    /**
     * @ORM\ManyToOne(targetEntity="Roles", inversedBy="teachers")
     * @ORM\JoinColumn(name="fk_role_id", referencedColumnName="id")
     */
    protected $role;

    /**
     * @ORM\OneToMany(targetEntity="Course", mappedBy="teacher")
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="welcomedByTeacher")
     */
    private $studentsWelcomed;

    /**
     * @ORM\OneToMany(targetEntity="ClassSession", mappedBy="sessionTeacher")
     */
    private $classSessionsDriven;
    
    /**
     * @ORM\OneToMany(targetEntity="ClassSession", mappedBy="reportTeacher")
     */
    private $classSessionsReported;    
    
    /**
     * @ORM\ManyToMany(targetEntity="OrganizationBranch", inversedBy="teachers")
     * @ORM\JoinTable(name="teachers_branches")
     */
    protected $organizationBranches;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function __construct() {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->username;
    }

    public function isEqualTo(UserInterface $user) {
        return $this->username === $user->getUsername();
    }
    
     public function equals(UserInterface $user) {
        return $this->username === $user->getUsername();
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Teacher
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Teacher
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Teacher
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Teacher
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * Set cellphoneNumber
     *
     * @param string $cellphoneNumber
     * @return Teacher
     */
    public function setCellphoneNumber($cellphoneNumber) {
        $this->cellphoneNumber = $cellphoneNumber;

        return $this;
    }

    /**
     * Get cellphoneNumber
     *
     * @return string 
     */
    public function getCellphoneNumber() {
        return $this->cellphoneNumber;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return Teacher
     */
    public function setEmailAddress($emailAddress) {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string 
     */
    public function getEmailAddress() {
        return $this->emailAddress;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Teacher
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Teacher
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     * @return Teacher
     */
    public function setRegistrationDate($registrationDate) {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime 
     */
    public function getRegistrationDate() {
        return $this->registrationDate;
    }

    /**
     * Set lastConnectionDate
     *
     * @param \DateTime $lastConnectionDate
     * @return Teacher
     */
    public function setLastConnectionDate($lastConnectionDate) {
        $this->lastConnectionDate = $lastConnectionDate;

        return $this;
    }

    /**
     * Get lastConnectionDate
     *
     * @return \DateTime 
     */
    public function getLastConnectionDate() {
        return $this->lastConnectionDate;
    }

    /**
     * Set role
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Roles $role
     * @return Teacher
     */
    public function setRole(\Virgule\Bundle\MainBundle\Entity\Roles $role = null) {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Roles 
     */
    public function getRole() {
        return $this->role;
    }

    public function getRoles() {
        return Array($this->getRole()->getCode());
    }

    /**
     * Add courses
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Course $courses
     * @return Teacher
     */
    public function addCourse(\Virgule\Bundle\MainBundle\Entity\Course $courses) {
        $this->courses[] = $courses;

        return $this;
    }

    /**
     * Remove courses
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Course $courses
     */
    public function removeCourse(\Virgule\Bundle\MainBundle\Entity\Course $courses) {
        $this->courses->removeElement($courses);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourses() {
        return $this->courses;
    }

    public function __toString() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * Add studentsWelcomed
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $studentsWelcomed
     * @return Teacher
     */
    public function addStudentsWelcomed(\Virgule\Bundle\MainBundle\Entity\Student $studentsWelcomed) {
        $this->studentsWelcomed[] = $studentsWelcomed;

        return $this;
    }

    /**
     * Remove studentsWelcomed
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $studentsWelcomed
     */
    public function removeStudentsWelcomed(\Virgule\Bundle\MainBundle\Entity\Student $studentsWelcomed) {
        $this->studentsWelcomed->removeElement($studentsWelcomed);
    }

    /**
     * Get studentsWelcomed
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudentsWelcomed() {
        return $this->studentsWelcomed;
    }

    /**
     * Add organizationBranches
     *
     * @param \Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranches
     * @return Teacher
     */
    public function addOrganizationBranch(\Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranches) {
        $this->organizationBranches[] = $organizationBranches;

        return $this;
    }

    /**
     * Remove organizationBranches
     *
     * @param \Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranches
     */
    public function removeOrganizationBranch(\Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranches) {
        $this->organizationBranches->removeElement($organizationBranches);
    }


    /**
     * Add organizationBranches
     *
     * @param \Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranches
     * @return Teacher
     */
    public function addOrganizationBranche(\Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranches)
    {
        $this->organizationBranches[] = $organizationBranches;
    
        return $this;
    }

    /**
     * Remove organizationBranches
     *
     * @param \Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranches
     */
    public function removeOrganizationBranche(\Virgule\Bundle\MainBundle\Entity\OrganizationBranch $organizationBranches)
    {
        $this->organizationBranches->removeElement($organizationBranches);
    }

    /**
     * Get organizationBranches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrganizationBranches()
    {
        return $this->organizationBranches;
    }

    /**
     * Add classSessionsDriven
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassSession $classSessionsDriven
     * @return Teacher
     */
    public function addClassSessionsDriven(\Virgule\Bundle\MainBundle\Entity\ClassSession $classSessionsDriven)
    {
        $this->classSessionsDriven[] = $classSessionsDriven;
    
        return $this;
    }

    /**
     * Remove classSessionsDriven
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassSession $classSessionsDriven
     */
    public function removeClassSessionsDriven(\Virgule\Bundle\MainBundle\Entity\ClassSession $classSessionsDriven)
    {
        $this->classSessionsDriven->removeElement($classSessionsDriven);
    }

    /**
     * Get classSessionsDriven
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassSessionsDriven()
    {
        return $this->classSessionsDriven;
    }

    /**
     * Add classSessionsReported
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassSession $classSessionsReported
     * @return Teacher
     */
    public function addClassSessionsReported(\Virgule\Bundle\MainBundle\Entity\ClassSession $classSessionsReported)
    {
        $this->classSessionsReported[] = $classSessionsReported;
    
        return $this;
    }

    /**
     * Remove classSessionsReported
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassSession $classSessionsReported
     */
    public function removeClassSessionsReported(\Virgule\Bundle\MainBundle\Entity\ClassSession $classSessionsReported)
    {
        $this->classSessionsReported->removeElement($classSessionsReported);
    }

    /**
     * Get classSessionsReported
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassSessionsReported()
    {
        return $this->classSessionsReported;
    }
}