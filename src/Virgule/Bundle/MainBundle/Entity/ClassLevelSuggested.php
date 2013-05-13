<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ClassLevelSuggested
 *
 * @ORM\Table(name="class_level_suggested")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\ClassLevelSuggestedRepository")
 */
class ClassLevelSuggested {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime $dateOfChange
     *
     * @ORM\Column(name="date_of_change", type="datetime", nullable=false)
     */
    private $dateOfChange;
    
    /**
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumn(name="fk_changer", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $changer;
    
    /**
     * @ORM\ManyToOne(targetEntity="ClassLevel")
     * @ORM\JoinColumn(name="fk_classlevel", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */    
    private $classLevel;
    
    /**
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="suggestedClassLevel")
     * @ORM\JoinColumn(name="fk_student", referencedColumnName="id")
     * @Assert\NotNull()
     */
    private $student;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set changer
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $changer
     * @return ClassLevelSuggested
     */
    public function setChanger(\Virgule\Bundle\MainBundle\Entity\Teacher $changer = null)
    {
        $this->changer = $changer;
    
        return $this;
    }

    /**
     * Get changer
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Teacher 
     */
    public function getChanger()
    {
        return $this->changer;
    }

    /**
     * Set classLevel
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevel
     * @return ClassLevelSuggested
     */
    public function setClassLevel(\Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevel = null)
    {
        $this->classLevel = $classLevel;
    
        return $this;
    }

    /**
     * Get classLevel
     *
     * @return \Virgule\Bundle\MainBundle\Entity\ClassLevel 
     */
    public function getClassLevel()
    {
        return $this->classLevel;
    }

    /**
     * Set student
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Student $student
     * @return ClassLevelSuggested
     */
    public function setStudent(\Virgule\Bundle\MainBundle\Entity\Student $student = null)
    {
        $this->student = $student;
    
        return $this;
    }

    /**
     * Get student
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set dateOfChange
     *
     * @param \DateTime $dateOfChange
     * @return ClassLevelSuggested
     */
    public function setDateOfChange($dateOfChange)
    {
        $this->dateOfChange = $dateOfChange;
    
        return $this;
    }

    /**
     * Get dateOfChange
     *
     * @return \DateTime 
     */
    public function getDateOfChange()
    {
        return $this->dateOfChange;
    }
}