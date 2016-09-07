<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Virgule\Bundle\MainBundle\Entity\Role
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity
 */
class Role implements RoleInterface {

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
   * @ORM\Column(name="label", type="string", length=50, nullable=true)
   */
  protected $label;

  /**
   * @var string $code
   *
   * @ORM\Column(name="role", type="string", length=30, nullable=true)
   */
  protected $role;

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
   * @param string $role
   * @return Roles
   */
  public function setRole($role) {
    $this->role = $role;

    return $this;
  }

  /**
   * Get code
   *
   * @return string
   */
  public function getRole() {
    return $this->role;
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

  public function __toString() {
    return $this->label;
  }

}
