<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Delegations
 *
 * @ORM\Table(name="delegations")
 * @ORM\Entity
 */
class Delegations
{
    /**
     * @var integer $idDelegation
     *
     * @ORM\Column(name="id_delegation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDelegation;

    /**
     * @var string $nomDelegation
     *
     * @ORM\Column(name="nom_delegation", type="string", length=100, nullable=false)
     */
    private $nomDelegation;

    /**
     * @var string $adresseDelegation
     *
     * @ORM\Column(name="adresse_delegation", type="string", length=250, nullable=true)
     */
    private $adresseDelegation;

    /**
     * @var string $nomPresidentDelegation
     *
     * @ORM\Column(name="nom_president_delegation", type="string", length=100, nullable=false)
     */
    private $nomPresidentDelegation;

    /**
     * @var string $telephoneDelegation
     *
     * @ORM\Column(name="telephone_delegation", type="string", length=10, nullable=true)
     */
    private $telephoneDelegation;

    /**
     * @var string $adresseEmailDelegation
     *
     * @ORM\Column(name="adresse_email_delegation", type="string", length=45, nullable=true)
     */
    private $adresseEmailDelegation;



    /**
     * Get idDelegation
     *
     * @return integer 
     */
    public function getIdDelegation()
    {
        return $this->idDelegation;
    }

    /**
     * Set nomDelegation
     *
     * @param string $nomDelegation
     */
    public function setNomDelegation($nomDelegation)
    {
        $this->nomDelegation = $nomDelegation;
    }

    /**
     * Get nomDelegation
     *
     * @return string 
     */
    public function getNomDelegation()
    {
        return $this->nomDelegation;
    }

    /**
     * Set adresseDelegation
     *
     * @param string $adresseDelegation
     */
    public function setAdresseDelegation($adresseDelegation)
    {
        $this->adresseDelegation = $adresseDelegation;
    }

    /**
     * Get adresseDelegation
     *
     * @return string 
     */
    public function getAdresseDelegation()
    {
        return $this->adresseDelegation;
    }

    /**
     * Set nomPresidentDelegation
     *
     * @param string $nomPresidentDelegation
     */
    public function setNomPresidentDelegation($nomPresidentDelegation)
    {
        $this->nomPresidentDelegation = $nomPresidentDelegation;
    }

    /**
     * Get nomPresidentDelegation
     *
     * @return string 
     */
    public function getNomPresidentDelegation()
    {
        return $this->nomPresidentDelegation;
    }

    /**
     * Set telephoneDelegation
     *
     * @param string $telephoneDelegation
     */
    public function setTelephoneDelegation($telephoneDelegation)
    {
        $this->telephoneDelegation = $telephoneDelegation;
    }

    /**
     * Get telephoneDelegation
     *
     * @return string 
     */
    public function getTelephoneDelegation()
    {
        return $this->telephoneDelegation;
    }

    /**
     * Set adresseEmailDelegation
     *
     * @param string $adresseEmailDelegation
     */
    public function setAdresseEmailDelegation($adresseEmailDelegation)
    {
        $this->adresseEmailDelegation = $adresseEmailDelegation;
    }

    /**
     * Get adresseEmailDelegation
     *
     * @return string 
     */
    public function getAdresseEmailDelegation()
    {
        return $this->adresseEmailDelegation;
    }
}