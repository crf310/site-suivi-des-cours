<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\ClassLevel
 *
 * @ORM\Table(name="class_level")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\ClassLevelRepository")
 */
class ClassLevel {

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
   * @ORM\Column(name="label", type="string", length=20, nullable=false)
   */
  private $label;

  /**
   * @var string $htmlColorCode
   *
   * @ORM\Column(name="html_color_code", type="string", length=7, nullable=false)
   */
  private $htmlColorCode;

  /**
   * @var string $position
   *
   * @ORM\Column(name="position", type="integer", length=2, nullable=false)
   */
  private $position;

  /**
   * @ORM\OneToMany(targetEntity="Course", mappedBy="classLevel")
   */
  private $courses;

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
   * @return ClassLevel
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
   * Set htmlColorCode
   *
   * @param string $htmlColorCode
   * @return ClassLevel
   */
  public function setHtmlColorCode($htmlColorCode) {
    $this->htmlColorCode = $htmlColorCode;

    return $this;
  }

  /**
   * Get htmlColorCode
   *
   * @return string 
   */
  public function getHtmlColorCode() {
    return $this->htmlColorCode;
  }

  /**
   * Set position
   *
   * @param string $position
   * @return ClassLevel
   */
  public function setPosition($position) {
    $this->position = $position;

    return $this;
  }

  /**
   * Get position
   *
   * @return string 
   */
  public function getPosition() {
    return $this->position;
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
   * @return ClassLevel
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
    return $this->getLabel();
  }

}
