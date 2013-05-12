<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Document
 *
 * @ORM\Table(name="attachments")
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
     * @var string $fileName
     *
     * @ORM\Column(name="fileName", type="text", nullable=false)
     */
    private $fileName;

    /**
     * @var \DateTime $UploadDate
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $UploadDate;

    /**
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumn(name="fk_teacher", referencedColumnName="id", nullable=false)
     */
    private $uploader;

    /**
     * @ORM\ManyToOne(targetEntity="ClassSession", inversedBy="documents")
     * @ORM\JoinColumn(name="fk_class_session", referencedColumnName="id")
     */
    private $classSession;

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
        $this->UploadDate = $uploadDate;

        return $this;
    }

    /**
     * Get UploadDate
     *
     * @return \DateTime 
     */
    public function getUploadDate() {
        return $this->UploadDate;
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

}