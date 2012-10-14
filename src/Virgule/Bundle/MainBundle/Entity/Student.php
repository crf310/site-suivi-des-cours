<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity
 */
class Student
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
     * @var \DateTime $registrationDate
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=false)
     */
    private $registrationDate;

    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=50, nullable=false)
     */
    private $lastname;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @var \DateTime $birthdate
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

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
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=true)
     */
    private $address;

    /**
     * @var string $zipcode
     *
     * @ORM\Column(name="zipcode", type="string", length=10, nullable=true)
     */
    private $zipcode;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=true)
     */
    private $city;

    /**
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=true)
     */
    private $gender;

    /**
     * @var string $nationality
     *
     * @ORM\Column(name="nationality", type="string", length=50, nullable=true)
     */
    private $nationality;

    /**
     * @var string $maritalStatus
     *
     * @ORM\Column(name="marital_status", type="string", length=20, nullable=true)
     */
    private $maritalStatus;

    /**
     * @var string $commentaires
     *
     * @ORM\Column(name="commentaires", type="text", nullable=true)
     */
    private $commentaires;

    /**
     * @var \DateTime $registringDate
     *
     * @ORM\Column(name="registring_date", type="date", nullable=false)
     */
    private $registringDate;

    /**
     * @var string $picturePath
     *
     * @ORM\Column(name="picture_path", type="string", length=50, nullable=true)
     */
    private $picturePath;

    /**
     * @var \DateTime $arrivalDate
     *
     * @ORM\Column(name="arrival_date", type="date", nullable=true)
     */
    private $arrivalDate;

    /**
     * @var boolean $scholarized
     *
     * @ORM\Column(name="scholarized", type="boolean", nullable=true)
     */
    private $scholarized;

    /**
     * @var string $profession
     *
     * @ORM\Column(name="profession", type="string", length=45, nullable=true)
     */
    private $profession;

    /**
     * @var boolean $scholarizedInTheCountry
     *
     * @ORM\Column(name="scholarized_in_the_country", type="boolean", nullable=true)
     */
    private $scholarizedInTheCountry;

    /**
     * @var boolean $scholarizedInAForeignCountry
     *
     * @ORM\Column(name="scholarized_in_a foreign_country", type="boolean", nullable=true)
     */
    private $scholarizedInAForeignCountry;

    /**
     * @var boolean $scholarizationLevel
     *
     * @ORM\Column(name="scholarization_level", type="boolean", nullable=true)
     */
    private $scholarizationLevel;

    /**
     * @var string $emergencyContactLastname
     *
     * @ORM\Column(name="emergency_contact_lastname", type="string", length=45, nullable=true)
     */
    private $emergencyContactLastname;

    /**
     * @var string $emergencyContactFirstname
     *
     * @ORM\Column(name="emergency_contact_firstname", type="string", length=45, nullable=true)
     */
    private $emergencyContactFirstname;

    /**
     * @var string $emergencyContactPhoneNumber
     *
     * @ORM\Column(name="emergency_contact_phone_number", type="string", length=45, nullable=true)
     */
    private $emergencyContactPhoneNumber;

    /**
     * @var string $emergencyContactConnectionType
     *
     * @ORM\Column(name="emergency_contact_connection_type", type="string", length=45, nullable=true)
     */
    private $emergencyContactConnectionType;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_native_country_id", referencedColumnName="id")
     * })
     */
    private $fkNativeCountry;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_welcomed_by_teacher_id", referencedColumnName="id")
     * })
     */
    private $fkWelcomedByTeacher;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_mother_tongue_id", referencedColumnName="id")
     * })
     */
    private $fkMotherTongue;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_scholarization_language_id", referencedColumnName="id")
     * })
     */
    private $fkScholarizationLanguage;

    /**
     * @var ClassLevel
     *
     * @ORM\ManyToOne(targetEntity="ClassLevel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_proposed_level_id", referencedColumnName="id")
     * })
     */
    private $fkProposedLevel;


}
