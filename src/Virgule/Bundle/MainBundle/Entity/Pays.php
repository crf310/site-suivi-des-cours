<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity
 */
class Pays
{
    /**
     * @var integer $idPays
     *
     * @ORM\Column(name="id_pays", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPays;

    /**
     * @var string $libellePays
     *
     * @ORM\Column(name="libelle_pays", type="string", length=50, nullable=false)
     */
    private $libellePays;

    /**
     * @var string $codeIso
     *
     * @ORM\Column(name="code_iso", type="string", length=3, nullable=false)
     */
    private $codeIso;



    /**
     * Get idPays
     *
     * @return integer 
     */
    public function getIdPays()
    {
        return $this->idPays;
    }

    /**
     * Set libellePays
     *
     * @param string $libellePays
     */
    public function setLibellePays($libellePays)
    {
        $this->libellePays = $libellePays;
    }

    /**
     * Get libellePays
     *
     * @return string 
     */
    public function getLibellePays()
    {
        return $this->libellePays;
    }

    /**
     * Set codeIso
     *
     * @param string $codeIso
     */
    public function setCodeIso($codeIso)
    {
        $this->codeIso = $codeIso;
    }

    /**
     * Get codeIso
     *
     * @return string 
     */
    public function getCodeIso()
    {
        return $this->codeIso;
    }
}