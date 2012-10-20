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
    private $id;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
     */
    private $lastName;

    /**
     * @var string $firstName
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=false)
     */
    private $firstName;

    /**
     * @var string $phoneNumber
     *
     * @ORM\Column(name="phone_number", type="string", length=10, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string $cellphoneNumber
     *
     * @ORM\Column(name="cellphone_number", type="string", length=10, nullable=true)
     */
    private $cellphoneNumber;

    /**
     * @var string $emailAddress
     *
     * @ORM\Column(name="email_address", type="string", length=50, nullable=true)
     */
    private $emailAddress;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime $registrationDate
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=false)
     */
    private $registrationDate;

    /**
     * @var \DateTime $lastConnectionDate
     *
     * @ORM\Column(name="last_connection_date", type="datetime", nullable=true)
     */
    private $lastConnectionDate;

    /**
     * @var integer $fkRoleId
     *
     * @ORM\Column(name="fk_role_id", type="integer", nullable=false)
     */
    private $fkRoleId;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
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

    public function getRoles() {
        return Array('ROLE_USER');
    }

    public function getSalt() {
    }

    public function getUsername() {
        return $this->username;
    }

    public function isEqualTo(UserInterface $user) {
        return $this->username === $user->getUsername();
    }
    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Teacher
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Teacher
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Teacher
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Teacher
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set cellphoneNumber
     *
     * @param string $cellphoneNumber
     * @return Teacher
     */
    public function setCellphoneNumber($cellphoneNumber)
    {
        $this->cellphoneNumber = $cellphoneNumber;
    
        return $this;
    }

    /**
     * Get cellphoneNumber
     *
     * @return string 
     */
    public function getCellphoneNumber()
    {
        return $this->cellphoneNumber;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return Teacher
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    
        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string 
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Teacher
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Teacher
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     * @return Teacher
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
    
        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime 
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Set lastConnectionDate
     *
     * @param \DateTime $lastConnectionDate
     * @return Teacher
     */
    public function setLastConnectionDate($lastConnectionDate)
    {
        $this->lastConnectionDate = $lastConnectionDate;
    
        return $this;
    }

    /**
     * Get lastConnectionDate
     *
     * @return \DateTime 
     */
    public function getLastConnectionDate()
    {
        return $this->lastConnectionDate;
    }

    /**
     * Set fkRoleId
     *
     * @param integer $fkRoleId
     * @return Teacher
     */
    public function setFkRoleId($fkRoleId)
    {
        $this->fkRoleId = $fkRoleId;
    
        return $this;
    }

    /**
     * Get fkRoleId
     *
     * @return integer 
     */
    public function getFkRoleId()
    {
        return $this->fkRoleId;
    }
}