<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Virgule\Bundle\MainBundle\Entity\Formateurs
 *
 * @ORM\Table(name="formateurs")
 * @ORM\Entity
 * @UniqueEntity("login")
 */
class Formateurs implements UserInterface
{
    /**
     * @var integer $idFormateur
     *
     * @ORM\Column(name="id_formateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormateur;

    /**
     * @var boolean $actifYn
     *
     * @ORM\Column(name="actif_yn", type="boolean", nullable=false)
     */
    private $actifYn;

    /**
     * @var string $nomFormateur
     *
     * @ORM\Column(name="nom_formateur", type="string", length=50, nullable=false)
     */
    private $nomFormateur;

    /**
     * @var string $prenomFormateur
     *
     * @ORM\Column(name="prenom_formateur", type="string", length=50, nullable=false)
     */
    private $prenomFormateur;

    /**
     * @var string $telFixe
     *
     * @ORM\Column(name="tel_fixe", type="string", length=10, nullable=true)
     */
    private $telFixe;

    /**
     * @var string $telPortable
     *
     * @ORM\Column(name="tel_portable", type="string", length=10, nullable=true)
     */
    private $telPortable;

    /**
     * @var string $adresseEmail
     *
     * @ORM\Column(name="adresse_email", type="string", length=50, nullable=true)
     */
    private $adresseEmail;

    /**
     * @var string $login
     *
     * @ORM\Column(name="login", type="string", length=50, nullable=false, unique = true))
     */
    private $login;

    /**
     * @var string $motDePasse
     *
     * @ORM\Column(name="mot_de_passe", type="string", length=50, nullable=false)
     */
    private $motDePasse;

    /**
     * @var datetime $dateInscription
     *
     * @ORM\Column(name="date_inscription", type="datetime", nullable=false)
     */
    private $dateInscription;

    /**
     * @var datetime $dateDerniereConnexion
     *
     * @ORM\Column(name="date_derniere_connexion", type="datetime", nullable=true)
     */
    private $dateDerniereConnexion;

    /**
     * @var Permissions
     *
     * @ORM\ManyToMany(targetEntity="Permissions", mappedBy="fkFormateur")
     */
    private $fkPermission;

    public function __construct()
    {
        $this->fkPermission = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idFormateur
     *
     * @return integer 
     */
    public function getIdFormateur()
    {
        return $this->idFormateur;
    }

    /**
     * Set actifYn
     *
     * @param boolean $actifYn
     */
    public function setActifYn($actifYn)
    {
        $this->actifYn = $actifYn;
    }

    /**
     * Get actifYn
     *
     * @return boolean 
     */
    public function getActifYn()
    {
        return $this->actifYn;
    }

    /**
     * Set nomFormateur
     *
     * @param string $nomFormateur
     */
    public function setNomFormateur($nomFormateur)
    {
        $this->nomFormateur = $nomFormateur;
    }

    /**
     * Get nomFormateur
     *
     * @return string 
     */
    public function getNomFormateur()
    {
        return $this->nomFormateur;
    }

    /**
     * Set prenomFormateur
     *
     * @param string $prenomFormateur
     */
    public function setPrenomFormateur($prenomFormateur)
    {
        $this->prenomFormateur = $prenomFormateur;
    }

    /**
     * Get prenomFormateur
     *
     * @return string 
     */
    public function getPrenomFormateur()
    {
        return $this->prenomFormateur;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     */
    public function setTelFixe($telFixe)
    {
        $this->telFixe = $telFixe;
    }

    /**
     * Get telFixe
     *
     * @return string 
     */
    public function getTelFixe()
    {
        return $this->telFixe;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     */
    public function setTelPortable($telPortable)
    {
        $this->telPortable = $telPortable;
    }

    /**
     * Get telPortable
     *
     * @return string 
     */
    public function getTelPortable()
    {
        return $this->telPortable;
    }

    /**
     * Set adresseEmail
     *
     * @param string $adresseEmail
     */
    public function setAdresseEmail($adresseEmail)
    {
        $this->adresseEmail = $adresseEmail;
    }

    /**
     * Get adresseEmail
     *
     * @return string 
     */
    public function getAdresseEmail()
    {
        return $this->adresseEmail;
    }

    /**
     * Set login
     *
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * Get motDePasse
     *
     * @return string 
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set dateInscription
     *
     * @param datetime $dateInscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * Get dateInscription
     *
     * @return datetime 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set dateDerniereConnexion
     *
     * @param datetime $dateDerniereConnexion
     */
    public function setDateDerniereConnexion($dateDerniereConnexion)
    {
        $this->dateDerniereConnexion = $dateDerniereConnexion;
    }

    /**
     * Get dateDerniereConnexion
     *
     * @return datetime 
     */
    public function getDateDerniereConnexion()
    {
        return $this->dateDerniereConnexion;
    }

    /**
     * Add fkPermission
     *
     * @param Virgule\Bundle\MainBundle\Entity\Permissions $fkPermission
     */
    public function addPermissions(\Virgule\Bundle\MainBundle\Entity\Permissions $fkPermission)
    {
        $this->fkPermission[] = $fkPermission;
    }

    /**
     * Get fkPermission
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFkPermission()
    {
        return $this->fkPermission;
    }

    public function equals(UserInterface $user) {
        
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->motDePasse;
    }

    public function getRoles() {
        // @TODO: get real roles
        return Array('ROLE_ADMIN');
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->login;
    }
}