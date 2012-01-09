<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Seances
 *
 * @ORM\Table(name="seances")
 * @ORM\Entity
 */
class Seances
{
    /**
     * @var integer $idSeance
     *
     * @ORM\Column(name="id_seance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSeance;

    /**
     * @var date $dateSeance
     *
     * @ORM\Column(name="date_seance", type="date", nullable=false)
     */
    private $dateSeance;

    /**
     * @var text $compteRendu
     *
     * @ORM\Column(name="compte_rendu", type="text", nullable=true)
     */
    private $compteRendu;

    /**
     * @var integer $fkIdFormateurSeance
     *
     * @ORM\Column(name="fk_id_formateur_seance", type="integer", nullable=false)
     */
    private $fkIdFormateurSeance;

    /**
     * @var integer $fkIdFormateurCompteRendu
     *
     * @ORM\Column(name="fk_id_formateur_compte_rendu", type="integer", nullable=false)
     */
    private $fkIdFormateurCompteRendu;

    /**
     * @var Apprenants
     *
     * @ORM\ManyToMany(targetEntity="Apprenants", mappedBy="fkSeance")
     */
    private $fkApprenant;

    /**
     * @var Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_cours", referencedColumnName="id_cours")
     * })
     */
    private $fkCours;

    public function __construct()
    {
        $this->fkApprenant = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idSeance
     *
     * @return integer 
     */
    public function getIdSeance()
    {
        return $this->idSeance;
    }

    /**
     * Set dateSeance
     *
     * @param date $dateSeance
     */
    public function setDateSeance($dateSeance)
    {
        $this->dateSeance = $dateSeance;
    }

    /**
     * Get dateSeance
     *
     * @return date 
     */
    public function getDateSeance()
    {
        return $this->dateSeance;
    }

    /**
     * Set compteRendu
     *
     * @param text $compteRendu
     */
    public function setCompteRendu($compteRendu)
    {
        $this->compteRendu = $compteRendu;
    }

    /**
     * Get compteRendu
     *
     * @return text 
     */
    public function getCompteRendu()
    {
        return $this->compteRendu;
    }

    /**
     * Set fkIdFormateurSeance
     *
     * @param integer $fkIdFormateurSeance
     */
    public function setFkIdFormateurSeance($fkIdFormateurSeance)
    {
        $this->fkIdFormateurSeance = $fkIdFormateurSeance;
    }

    /**
     * Get fkIdFormateurSeance
     *
     * @return integer 
     */
    public function getFkIdFormateurSeance()
    {
        return $this->fkIdFormateurSeance;
    }

    /**
     * Set fkIdFormateurCompteRendu
     *
     * @param integer $fkIdFormateurCompteRendu
     */
    public function setFkIdFormateurCompteRendu($fkIdFormateurCompteRendu)
    {
        $this->fkIdFormateurCompteRendu = $fkIdFormateurCompteRendu;
    }

    /**
     * Get fkIdFormateurCompteRendu
     *
     * @return integer 
     */
    public function getFkIdFormateurCompteRendu()
    {
        return $this->fkIdFormateurCompteRendu;
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

    /**
     * Set fkCours
     *
     * @param Virgule\Bundle\MainBundle\Entity\Cours $fkCours
     */
    public function setFkCours(\Virgule\Bundle\MainBundle\Entity\Cours $fkCours)
    {
        $this->fkCours = $fkCours;
    }

    /**
     * Get fkCours
     *
     * @return Virgule\Bundle\MainBundle\Entity\Cours 
     */
    public function getFkCours()
    {
        return $this->fkCours;
    }
}