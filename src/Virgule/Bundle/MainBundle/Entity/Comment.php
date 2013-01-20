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
    private $fk_teacher;

    /**
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="comments"), cascade={"persist", "remove"}
     * @ORM\JoinColumn(name="fk_student", referencedColumnName="id")
     */
    private $student;
    private $fk_student;

    /**
     * @ORM\ManyToOne(targetEntity="ClassSession", inversedBy="comments")
     * @ORM\JoinColumn(name="fk_class_session", referencedColumnName="id")
     */
    private $classSession;

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
     * Set fkTeacher
     *
     * @param integer $fkTeacher
     * @return Comment
     */
    public function setFkTeacher($fkTeacher) {
        $this->fkTeacher = $fkTeacher;

        return $this;
    }
    
    /**
     * Set fkStudent
     *
     * @param integer $fkStudent
     * @return Comment
     */
    public function setFkStudent($fkStudent) {
        $this->fkStudent = $fkStudent;

        return $this;
    }
}