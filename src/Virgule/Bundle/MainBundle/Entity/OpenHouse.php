<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Semester
 *
 * @ORM\Table(name="open_house")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\OpenHouseRepository")
 */
class OpenHouse {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="open_house_date", type="date", nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Semester", inversedBy="openHouses")
     * @ORM\JoinColumn(name="fk_semester", referencedColumnName="id", nullable=false)
     */
    private $semester;

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
     * @return OpenHouse
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
     * Set semester
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Semester $semester
     * @return OpenHouse
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

}