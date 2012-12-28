<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\CountryRepository")
 */
class Country {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $label
     *
     * @ORM\Column(name="label", type="string", length=50, nullable=false)
     */
    private $label;

    /**
     * @var string $isoCode
     *
     * @ORM\Column(name="iso_code", type="string", length=3, nullable=false)
     */
    private $isoCode;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="nativeCountry")
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
     * Set label
     *
     * @param string $label
     * @return Country
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set isoCode
     *
     * @param string $isoCode
     * @return Country
     */
    public function setIsoCode($isoCode) {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * Get isoCode
     *
     * @return string 
     */
    public function getIsoCode() {
        return $this->isoCode;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add students
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $students
     * @return Country
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

}