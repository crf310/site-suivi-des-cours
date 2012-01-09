<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\RaisonsApprentissage
 *
 * @ORM\Table(name="raisons_apprentissage")
 * @ORM\Entity
 */
class RaisonsApprentissage
{
    /**
     * @var integer $idRaisonApprentissage
     *
     * @ORM\Column(name="id_raison_apprentissage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRaisonApprentissage;

    /**
     * @var string $libelleRaisonApprentissage
     *
     * @ORM\Column(name="libelle_raison_apprentissage", type="string", length=100, nullable=true)
     */
    private $libelleRaisonApprentissage;

    /**
     * @var Apprenants
     *
     * @ORM\ManyToMany(targetEntity="Apprenants", inversedBy="fkRaisonApprentissage")
     * @ORM\JoinTable(name="a_comme",
     *   joinColumns={
     *     @ORM\JoinColumn(name="fk_id_raison_apprentissage", referencedColumnName="id_raison_apprentissage")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="fk_id_apprenant", referencedColumnName="id_apprenant")
     *   }
     * )
     */
    private $fkApprenant;

    public function __construct()
    {
        $this->fkApprenant = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idRaisonApprentissage
     *
     * @return integer 
     */
    public function getIdRaisonApprentissage()
    {
        return $this->idRaisonApprentissage;
    }

    /**
     * Set libelleRaisonApprentissage
     *
     * @param string $libelleRaisonApprentissage
     */
    public function setLibelleRaisonApprentissage($libelleRaisonApprentissage)
    {
        $this->libelleRaisonApprentissage = $libelleRaisonApprentissage;
    }

    /**
     * Get libelleRaisonApprentissage
     *
     * @return string 
     */
    public function getLibelleRaisonApprentissage()
    {
        return $this->libelleRaisonApprentissage;
    }

    /**
     * Add fkApprenant
     *
     * @param Virgule\Bundle\MainBundle\Entity\Apprenants $fkApprenant
     */
    public function addApprenants(\Virgule\Bundle\MainBundle\Entity\Apprenants $fkApprenant)
    {
        $this->fkApprenant[] = $fkApprenant;
    }

    /**
     * Get fkApprenant
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFkApprenant()
    {
        return $this->fkApprenant;
    }
}