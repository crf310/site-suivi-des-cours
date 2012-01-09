<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Langues
 *
 * @ORM\Table(name="langues")
 * @ORM\Entity
 */
class Langues
{
    /**
     * @var integer $idLangue
     *
     * @ORM\Column(name="id_langue", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLangue;

    /**
     * @var string $libelleLangue
     *
     * @ORM\Column(name="libelle_langue", type="string", length=45, nullable=true)
     */
    private $libelleLangue;

    /**
     * @var Apprenants
     *
     * @ORM\ManyToMany(targetEntity="Apprenants", inversedBy="fkLangue")
     * @ORM\JoinTable(name="parle",
     *   joinColumns={
     *     @ORM\JoinColumn(name="fk_id_langue", referencedColumnName="id_langue")
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
     * Get idLangue
     *
     * @return integer 
     */
    public function getIdLangue()
    {
        return $this->idLangue;
    }

    /**
     * Set libelleLangue
     *
     * @param string $libelleLangue
     */
    public function setLibelleLangue($libelleLangue)
    {
        $this->libelleLangue = $libelleLangue;
    }

    /**
     * Get libelleLangue
     *
     * @return string 
     */
    public function getLibelleLangue()
    {
        return $this->libelleLangue;
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