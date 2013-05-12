<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Entity\TagRepository")
 */
class Tag
{
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
     * @ORM\Column(name="tagLabel", type="string", length=255)
     */
    private $tagLabel;

    /**
     * @ORM\ManyToMany(targetEntity="Document", mappedBy="tags")
     */
    private $documents;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tagLabel
     *
     * @param string $tagLabel
     * @return Tag
     */
    public function setTagLabel($tagLabel)
    {
        $this->tagLabel = $tagLabel;
    
        return $this;
    }

    /**
     * Get tagLabel
     *
     * @return string 
     */
    public function getTagLabel()
    {
        return $this->tagLabel;
    }
}
