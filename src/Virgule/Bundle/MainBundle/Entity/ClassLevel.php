<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\ClassLevel
 *
 * @ORM\Table(name="class_level")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\ClassLevelRepository")
 */
class ClassLevel
{
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
     * @ORM\Column(name="label", type="string", length=20, nullable=true)
     */
    private $label;

    /**
     * @var string $htmlColorCode
     *
     * @ORM\Column(name="html_color_code", type="string", length=7, nullable=true)
     */
    private $htmlColorCode;



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
     * Set label
     *
     * @param string $label
     * @return ClassLevel
     */
    public function setLabel($label)
    {
        $this->label = $label;
    
        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set htmlColorCode
     *
     * @param string $htmlColorCode
     * @return ClassLevel
     */
    public function setHtmlColorCode($htmlColorCode)
    {
        $this->htmlColorCode = $htmlColorCode;
    
        return $this;
    }

    /**
     * Get htmlColorCode
     *
     * @return string 
     */
    public function getHtmlColorCode()
    {
        return $this->htmlColorCode;
    }
}