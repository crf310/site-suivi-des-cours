<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Niveaux
 *
 * @ORM\Table(name="niveaux")
 * @ORM\Entity
 */
class Niveaux
{
    /**
     * @var integer $idNiveau
     *
     * @ORM\Column(name="id_niveau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNiveau;

    /**
     * @var string $libelleNiveau
     *
     * @ORM\Column(name="libelle_niveau", type="string", length=20, nullable=true)
     */
    private $libelleNiveau;

    /**
     * @var string $codeCouleur
     *
     * @ORM\Column(name="code_couleur", type="string", length=7, nullable=true)
     */
    private $codeCouleur;



    /**
     * Get idNiveau
     *
     * @return integer 
     */
    public function getIdNiveau()
    {
        return $this->idNiveau;
    }

    /**
     * Set libelleNiveau
     *
     * @param string $libelleNiveau
     */
    public function setLibelleNiveau($libelleNiveau)
    {
        $this->libelleNiveau = $libelleNiveau;
    }

    /**
     * Get libelleNiveau
     *
     * @return string 
     */
    public function getLibelleNiveau()
    {
        return $this->libelleNiveau;
    }

    /**
     * Set codeCouleur
     *
     * @param string $codeCouleur
     */
    public function setCodeCouleur($codeCouleur)
    {
        $this->codeCouleur = $codeCouleur;
    }

    /**
     * Get codeCouleur
     *
     * @return string 
     */
    public function getCodeCouleur()
    {
        return $this->codeCouleur;
    }
}