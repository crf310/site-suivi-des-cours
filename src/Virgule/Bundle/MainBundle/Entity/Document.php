<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Virgule\Bundle\MainBundle\Entity\Document
 *
 * @ORM\Table(name="documents")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\DocumentRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * @var string $path
     * 
     * @ORM\Column(name="file_path", type="string", length=50, nullable=false)
     */
    private $path;

    /**
     * @var string $fileName
     *
     * @ORM\Column(name="file_name", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Merci de saisir un nom pour ce document")
     * @Assert\NotNull()
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
     * @ORM\Column(name="upload_date", type="datetime", nullable=false)
     */
    private $uploadDate;

    /**
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumn(name="fk_teacher", referencedColumnName="id", nullable=false)
     */
    private $uploader;

    /**
     * @ORM\ManyToMany(targetEntity="ClassSession", mappedBy="documents")
     */
    private $classSessions;

    /**
     * @ORM\ManyToMany(targetEntity="ClassLevel")
     * @ORM\JoinTable(name="document_class_level")
     */
    private $classLevels;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="documents", cascade={"persist"})
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
     * Set classSessions
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassSession $classSession
     * @return Document
     */
    public function setClassSessions(\Virgule\Bundle\MainBundle\Entity\ClassSession $classSessions = null) {
        $this->classSessions = $classSessions;

        return $this;
    }

    /**
     * Get classSession
     *
     * @return \Virgule\Bundle\MainBundle\Entity\ClassSession 
     */
    public function getClassSessions() {
        return $this->classSessions;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->classLevelss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add classLevels
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevels
     * @return Document
     */
    public function addClassLevel(\Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevels) {
        $this->classLevels[] = $classLevels;

        return $this;
    }

    /**
     * Remove classLevels
     *
     * @param \Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevels
     */
    public function removeClassLevel(\Virgule\Bundle\MainBundle\Entity\ClassLevel $classLevels) {
        $this->classLevels->removeElement($classLevels);
    }

    /**
     * Get classLevels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassLevels() {
        return $this->classLevels;
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

    // UPLOAD

    private $temp;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile() {
        return $this->file;
    }
    
    
    public function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }
    
    public function getPath() {
        return $this->path;
    }
    public function setPath($path) {
        $this->path = $path;
    }
    
    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

}
