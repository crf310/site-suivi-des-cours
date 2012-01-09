<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity
 */
class Cours
{
    /**
     * @var integer $idCours
     *
     * @ORM\Column(name="id_cours", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCours;

    /**
     * @var boolean $jour
     *
     * @ORM\Column(name="jour", type="boolean", nullable=false)
     */
    private $jour;

    /**
     * @var time $heureDebut
     *
     * @ORM\Column(name="heure_debut", type="time", nullable=false)
     */
    private $heureDebut;

    /**
     * @var time $heureFin
     *
     * @ORM\Column(name="heure_fin", type="time", nullable=false)
     */
    private $heureFin;

    /**
     * @var Apprenants
     *
     * @ORM\ManyToMany(targetEntity="Apprenants", mappedBy="fkCours")
     */
    private $fkApprenant;

    /**
     * @var Formateurs
     *
     * @ORM\ManyToOne(targetEntity="Formateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_formateur", referencedColumnName="id_formateur")
     * })
     */
    private $fkFormateur;

    /**
     * @var Niveaux
     *
     * @ORM\ManyToOne(targetEntity="Niveaux")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_niveau", referencedColumnName="id_niveau")
     * })
     */
    private $fkNiveau;

    /**
     * @var Sessions
     *
     * @ORM\ManyToOne(targetEntity="Sessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_session", referencedColumnName="id_session")
     * })
     */
    private $fkSession;

    public function __construct()
    {
        $this->fkApprenant = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idCours
     *
     * @return integer 
     */
    public function getIdCours()
    {
        return $this->idCours;
    }

    /**
     * Set jour
     *
     * @param boolean $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    /**
     * Get jour
     *
     * @return boolean 
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set heureDebut
     *
     * @param time $heureDebut
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * Get heureDebut
     *
     * @return time 
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param time $heureFin
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    }

    /**
     * Get heureFin
     *
     * @return time 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
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
     * Set fkFormateur
     *
     * @param Virgule\Bundle\MainBundle\Entity\Formateurs $fkFormateur
     */
    public function setFkFormateur(\Virgule\Bundle\MainBundle\Entity\Formateurs $fkFormateur)
    {
        $this->fkFormateur = $fkFormateur;
    }

    /**
     * Get fkFormateur
     *
     * @return Virgule\Bundle\MainBundle\Entity\Formateurs 
     */
    public function getFkFormateur()
    {
        return $this->fkFormateur;
    }

    /**
     * Set fkNiveau
     *
     * @param Virgule\Bundle\MainBundle\Entity\Niveaux $fkNiveau
     */
    public function setFkNiveau(\Virgule\Bundle\MainBundle\Entity\Niveaux $fkNiveau)
    {
        $this->fkNiveau = $fkNiveau;
    }

    /**
     * Get fkNiveau
     *
     * @return Virgule\Bundle\MainBundle\Entity\Niveaux 
     */
    public function getFkNiveau()
    {
        return $this->fkNiveau;
    }

    /**
     * Set fkSession
     *
     * @param Virgule\Bundle\MainBundle\Entity\Sessions $fkSession
     */
    public function setFkSession(\Virgule\Bundle\MainBundle\Entity\Sessions $fkSession)
    {
        $this->fkSession = $fkSession;
    }

    /**
     * Get fkSession
     *
     * @return Virgule\Bundle\MainBundle\Entity\Sessions 
     */
    public function getFkSession()
    {
        return $this->fkSession;
    }
}