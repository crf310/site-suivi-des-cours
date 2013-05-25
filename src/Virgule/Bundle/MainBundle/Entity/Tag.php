<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Entity\TagRepository")
 */
class Tag {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=25, nullable=false, unique = true)
     */
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity="Document", mappedBy="tags")
     */
    private $documents;

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
     * @return Tag
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get tagLabel
     *
     * @return string 
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
    }

}