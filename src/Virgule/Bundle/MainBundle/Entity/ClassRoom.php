<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classroom
 *
 * @ORM\Table(name="classroom")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\ClassRoomRepository")
 */
class ClassRoom {

  /**
   * @var boolean
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
   * @ORM\Column(name="comments", type="string", length=250, nullable=true)
   */
  private $comments;

  /**
   * @var string
   *
   * @ORM\Column(name="address", type="string", length=250, nullable=true)
   */
  private $address;

  /**
   * @ORM\ManyToOne(targetEntity="OrganizationBranch", inversedBy="classRooms")
   * @ORM\JoinColumn(name="fk_organization_branch", referencedColumnName="id")
   */
  private $organizationBranch;

  /**
   * @ORM\OneToMany(targetEntity="Course", mappedBy="classRoom")
   */
  private $courses;

  /**
   * Get id
   *
   * @return boolean 
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   * @return Classroom
   */
  public function setName($name) {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name
   *
   * @return string 
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set comments
   *
   * @param string $comments
   * @return Classroom
   */
  public function setComments($comments) {
    $this->comments = $comments;

    return $this;
  }

  /**
   * Get comments
   *
   * @return string 
   */
  public function getComments() {
    return $this->comments;
  }

  /**
   * Set address
   *
   * @param string $address
   * @return Classroom
   */
  public function setAddress($address) {
    $this->address = $address;

    return $this;
  }

  /**
   * Get address
   *
   * @return string 
   */
  public function getAddress() {
    return $this->address;
  }

  /**
   * Set organizationBranch
   *
   * @param \Virgule\Bundle\MainBundle\Entity\organizationBranch $organizationBranch
   * @return ClassRoom
   */
  public function setOrganizationBranch(\Virgule\Bundle\MainBundle\Entity\organizationBranch $organizationBranch = null) {
    $this->organizationBranch = $organizationBranch;

    return $this;
  }

  /**
   * Get organizationBranch
   *
   * @return \Virgule\Bundle\MainBundle\Entity\organizationBranch 
   */
  public function getOrganizationBranch() {
    return $this->organizationBranch;
  }

  /**
   * Constructor
   */
  public function __construct() {
    $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Add courses
   *
   * @param \Virgule\Bundle\MainBundle\Entity\Course $courses
   * @return ClassRoom
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

}
