<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Permissions
 *
 * @ORM\Table(name="permissions")
 * @ORM\Entity
 */
class Permissions
{
    /**
     * @var integer $idPermission
     *
     * @ORM\Column(name="id_permission", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPermission;

    /**
     * @var string $libellePermission
     *
     * @ORM\Column(name="libelle_permission", type="string", length=30, nullable=true)
     */
    private $libellePermission;

    /**
     * @var string $codePermission
     *
     * @ORM\Column(name="code_permission", type="string", length=5, nullable=true)
     */
    private $codePermission;

    /**
     * @var Formateurs
     *
     * @ORM\ManyToMany(targetEntity="Formateurs", inversedBy="fkPermission")
     * @ORM\JoinTable(name="possede",
     *   joinColumns={
     *     @ORM\JoinColumn(name="fk_id_permission", referencedColumnName="id_permission")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="fk_id_formateur", referencedColumnName="id_formateur")
     *   }
     * )
     */
    private $fkFormateur;

    public function __construct()
    {
        $this->fkFormateur = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idPermission
     *
     * @return integer 
     */
    public function getIdPermission()
    {
        return $this->idPermission;
    }

    /**
     * Set libellePermission
     *
     * @param string $libellePermission
     */
    public function setLibellePermission($libellePermission)
    {
        $this->libellePermission = $libellePermission;
    }

    /**
     * Get libellePermission
     *
     * @return string 
     */
    public function getLibellePermission()
    {
        return $this->libellePermission;
    }

    /**
     * Set codePermission
     *
     * @param string $codePermission
     */
    public function setCodePermission($codePermission)
    {
        $this->codePermission = $codePermission;
    }

    /**
     * Get codePermission
     *
     * @return string 
     */
    public function getCodePermission()
    {
        return $this->codePermission;
    }

    /**
     * Add fkFormateur
     *
     * @param Virgule\Bundle\MainBundle\Entity\Formateurs $fkFormateur
     */
    public function addFormateurs(\Virgule\Bundle\MainBundle\Entity\Formateurs $fkFormateur)
    {
        $this->fkFormateur[] = $fkFormateur;
    }

    /**
     * Get fkFormateur
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFkFormateur()
    {
        return $this->fkFormateur;
    }
}