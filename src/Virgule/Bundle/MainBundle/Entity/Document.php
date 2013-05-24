<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Virgule\Bundle\MainBundle\Entity\Document
 *
 * @ORM\Table(name="documents")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\DocumentRepository")
 */
class Document {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $file
     *
     * @ORM\Column(name="file", type="string", length=50, nullable=false)
     */
    private $file;

    /**
     * @var string $fileName
     *
     * @ORM\Column(name="fileName", type="string", length=50, nullable=false)
     */
    private $fileName;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime $UploadDate
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $uploadDate;

    /**
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumn(name="fk_teacher", referencedColumnName="id", nullable=false)
     */
    private $uploader;

    /**
     * @ORM\ManyToOne(targetEntity="ClassSession", inversedBy="documents")
     * @ORM\JoinColumn(name="fk_class_session", referencedColumnName="id", nullable=true)
     */
    private $classSession;

    /**
     * @ORM\ManyToMany(targetEntity="ClassLevel")
     * @ORM\JoinTable(name="document_class_level")
     * @Assert\NotNull
     */
    private $classLevel;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="documents")
     * @ORM\JoinTable(name="document_tag")
     */
    private $tags;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return Document
     */
    public function setFileName($fileName) {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName() {
        return $this->fileName;
    }

    /**
     * Set UploadDate
     *
     * @param \DateTime $uploadDate
     * @return Document
     */
    public function setUploadDate($uploadDate) {
        $this->uploadDate = $uploadDate;

        return $this;
    }

    /**
     * Get UploadDate
     *
     * @return \DateTime 
     */
    public function getUploadDate() {
        return $this->uploadDate;
    }

    /**
     * Set uploader
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $uploader
     * @return Document
     */
    public function setUploader(\Virgule\Bundle\MainBundle\Entity\Teacher $uploader) {
        $this->uploader = $uploader;

        return $this;
    }

    /**
     * Get uploader
     *
     * @return \Virgule\Bundle\MainBundle\Entity\Teacher 
     */
    public function getUploader() {
        return $this->uploader;
    }

    /**
     * Set classSession
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassSession $classSession
     * @return Document
     */
    public function setClassSession(\Virgule\Bundle\MainBundle\Entity\ClassSession $classSession = null) {
        $this->classSession = $classSession;

        return $this;
    }

    /**
     * Get classSession
     *
     * @return \Virgule\Bundle\MainBundle\Entity\ClassSession 
     */
    public function getClassSession() {
        return $this->classSession;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->classLevel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add classLevel
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevel
     * @return Document
     */
    public function addClassLevel(\Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevel) {
        $this->classLevel[] = $classLevel;

        return $this;
    }

    /**
     * Remove classLevel
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevel
     */
    public function removeClassLevel(\Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevel) {
        $this->classLevel->removeElement($classLevel);
    }

    /**
     * Get classLevel
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassLevel() {
        return $this->classLevel;
    }

    /**
     * Add tags
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Tag $tags
     * @return Document
     */
    public function addTag(\Virgule\Bundle\MainBundle\Entity\Tag $tags) {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Virgule\Bundle\MainBundle\Entity\Tag $tags
     */
    public function removeTag(\Virgule\Bundle\MainBundle\Entity\Tag $tags) {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return Document
     */
    public function setFile($file) {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Document
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

}