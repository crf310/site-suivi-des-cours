<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\CommentRepository")
 */
class Comment {

  /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  private $id;

  /**
   * @var string $comment
   *
   * @ORM\Column(name="comment", type="text", nullable=true)
   */
  private $comment;

  /**
   * @var \DateTime $date
   *
   * @ORM\Column(name="date", type="datetime", nullable=false)
   */
  private $date;

  /**
   * @ORM\ManyToOne(targetEntity="Teacher")
   * @ORM\JoinColumn(name="fk_teacher", referencedColumnName="id")
   */
  private $teacher;

  /**
   * @ORM\ManyToOne(targetEntity="Student", inversedBy="comments")
   * @ORM\JoinColumn(name="fk_student", referencedColumnName="id")
   */
  private $student;

  /**
   * @ORM\ManyToMany(targetEntity="Teacher", inversedBy="commentsRead")
   * @ORM\JoinTable(name="teachers_comments_read")
   */
  private $readByTeachers;

  /**
   * Constructor
   */
  public function __construct() {
    $this->date = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer 
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set comment
   *
   * @param string $comment
   * @return Comment
   */
  public function setComment($comment) {
    $this->comment = $comment;

    return $this;
  }

  /**
   * Get comment
   *
   * @return string 
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * Set date
   *
   * @param \DateTime $date
   * @return Comment
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
   * Set teacher
   *
   * @param \Virgule\Bundle\MainBundle\Entity\Teacher $teacher
   * @return Comment
   */
  public function setTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $teacher = null) {
    $this->teacher = $teacher;

    return $this;
  }

  /**
   * Get teacher
   *
   * @return \Virgule\Bundle\MainBundle\Entity\Teacher 
   */
  public function getTeacher() {
    return $this->teacher;
  }

  /**
   * Set student
   *
   * @param \Virgule\Bundle\MainBundle\Entity\Student $student
   * @return Comment
   */
  public function setStudent(\Virgule\Bundle\MainBundle\Entity\Student $student = null) {
    $this->student = $student;

    return $this;
  }

  /**
   * Get student
   *
   * @return \Virgule\Bundle\MainBundle\Entity\Student 
   */
  public function getStudent() {
    return $this->student;
  }

  /**
   * Add readByTeachers
   *
   * @param \Virgule\Bundle\MainBundle\Entity\Teacher $readByTeachers
   * @return Comment
   */
  public function addReadByTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $readByTeachers) {
    $this->readByTeachers[] = $readByTeachers;

    return $this;
  }

  /**
   * Remove readByTeachers
   *
   * @param \Virgule\Bundle\MainBundle\Entity\Teacher $readByTeachers
   */
  public function removeReadByTeacher(\Virgule\Bundle\MainBundle\Entity\Teacher $readByTeachers) {
    $this->readByTeachers->removeElement($readByTeachers);
  }

  /**
   * Get readByTeachers
   *
   * @return \Doctrine\Common\Collections\Collection 
   */
  public function getReadByTeachers() {
    return $this->readByTeachers;
  }

}
