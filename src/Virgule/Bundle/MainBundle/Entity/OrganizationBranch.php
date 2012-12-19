<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrganizationBranch
 *
 * @ORM\Table(name="organization_branch")
 * @ORM\Entity
 */
class OrganizationBranch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=250, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="president_name", type="string", length=100, nullable=false)
     */
    private $presidentName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=10, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="fax_number", type="string", length=10, nullable=true)
     */
    private $faxNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email_address", type="string", length=45, nullable=true)
     */
    private $emailAddress;



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
     * Set name
     *
     * @param string $name
     * @return OrganizationBranch
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return OrganizationBranch
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set presidentName
     *
     * @param string $presidentName
     * @return OrganizationBranch
     */
    public function setPresidentName($presidentName)
    {
        $this->presidentName = $presidentName;
    
        return $this;
    }

    /**
     * Get presidentName
     *
     * @return string 
     */
    public function getPresidentName()
    {
        return $this->presidentName;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return OrganizationBranch
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
     * Set faxNumber
     *
     * @param string $faxNumber
     * @return OrganizationBranch
     */
    public function setFaxNumber($faxNumber)
    {
        $this->faxNumber = $faxNumber;
    
        return $this;
    }

    /**
     * Get faxNumber
     *
     * @return string 
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return OrganizationBranch
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
}