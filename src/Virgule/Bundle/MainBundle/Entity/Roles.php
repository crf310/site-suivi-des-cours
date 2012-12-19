<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Virgule\Bundle\MainBundle\Entity\Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity
 */
class Roles implements RoleInterface {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string $label
     *
     * @ORM\Column(name="label", type="string", length=30, nullable=true)
     */
    protected $label;

    /**
     * @var string $code
     *
     * @ORM\Column(name="code", type="string", length=30, nullable=true)
     */
    protected $code;

    /**
     * @ORM\OneToMany(targetEntity="Teacher", mappedBy="role")
     */
    protected $teachers;

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
     * @return Roles
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
     * Set code
     *
     * @param string $code
     * @return Roles
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode() {
        return $this->code;
    }

    public function getRole() {
        
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->teachers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add teachers
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $teachers
     * @return Roles
     */
    public function addTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $teachers) {
        $this->teachers[] = $teachers;
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