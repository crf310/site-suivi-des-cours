<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Language
 *
 * @ORM\Table(name="language")
 * @ORM\Entity(repositoryClass="Virgule\Bundle\MainBundle\Repository\LanguageRepository")
 */
class Language
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string $alternativeNames
     *
     * @ORM\Column(name="alternative_names", type="string", length=150, nullable=true)
     */
    private $alternativeNames;



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
     * Set name
     *
     * @param string $name
     * @return Language
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set alternativeNames
     *
     * @param string $alternativeNames
     * @return Language
     */
    public function setAlternativeNames($alternativeNames)
    {
        $this->alternativeNames = $alternativeNames;
    
        return $this;
    }

    /**
     * Get alternativeNames
     *
     * @return string 
     */
    public function getAlternativeNames()
    {
        return $this->alternativeNames;
    }
}