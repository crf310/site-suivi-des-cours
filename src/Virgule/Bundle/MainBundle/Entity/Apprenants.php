<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\Apprenants
 *
 * @ORM\Table(name="apprenants")
 * @ORM\Entity
 */
class Apprenants
{
    /**
     * @var integer $idApprenant
     *
     * @ORM\Column(name="id_apprenant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idApprenant;

    /**
     * @var datetime $dateMiseAJour
     *
     * @ORM\Column(name="date_mise_a_jour", type="datetime", nullable=false)
     */
    private $dateMiseAJour;

    /**
     * @var boolean $actifYn
     *
     * @ORM\Column(name="actif_yn", type="boolean", nullable=false)
     */
    private $actifYn;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=5, nullable=true)
     */
    private $titre;

    /**
     * @var string $nomApprenant
     *
     * @ORM\Column(name="nom_apprenant", type="string", length=50, nullable=true)
     */
    private $nomApprenant;

    /**
     * @var string $prenomApprenant
     *
     * @ORM\Column(name="prenom_apprenant", type="string", length=50, nullable=true)
     */
    private $prenomApprenant;

    /**
     * @var date $dateDeNaissance
     *
     * @ORM\Column(name="date_de_naissance", type="date", nullable=true)
     */
    private $dateDeNaissance;

    /**
     * @var string $telFixeApprenant
     *
     * @ORM\Column(name="tel_fixe_apprenant", type="string", length=10, nullable=true)
     */
    private $telFixeApprenant;

    /**
     * @var string $telPortableApprenant
     *
     * @ORM\Column(name="tel_portable_apprenant", type="string", length=10, nullable=true)
     */
    private $telPortableApprenant;

    /**
     * @var string $adresse
     *
     * @ORM\Column(name="adresse", type="string", length=50, nullable=true)
     */
    private $adresse;

    /**
     * @var string $codePostal
     *
     * @ORM\Column(name="code_postal", type="string", length=10, nullable=true)
     */
    private $codePostal;

    /**
     * @var string $ville
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=true)
     */
    private $ville;

    /**
     * @var string $sexe
     *
     * @ORM\Column(name="sexe", type="string", length=1, nullable=true)
     */
    private $sexe;

    /**
     * @var string $nationalite
     *
     * @ORM\Column(name="nationalite", type="string", length=50, nullable=true)
     */
    private $nationalite;

    /**
     * @var string $situationFamiliale
     *
     * @ORM\Column(name="situation_familiale", type="string", length=20, nullable=true)
     */
    private $situationFamiliale;

    /**
     * @var text $commentaires
     *
     * @ORM\Column(name="commentaires", type="text", nullable=true)
     */
    private $commentaires;

    /**
     * @var date $dateInscription
     *
     * @ORM\Column(name="date_inscription", type="date", nullable=false)
     */
    private $dateInscription;

    /**
     * @var string $cheminPhoto
     *
     * @ORM\Column(name="chemin_photo", type="string", length=50, nullable=true)
     */
    private $cheminPhoto;

    /**
     * @var boolean $communicationOrale
     *
     * @ORM\Column(name="communication_orale", type="boolean", nullable=true)
     */
    private $communicationOrale;

    /**
     * @var date $dateArriveeEnFrance
     *
     * @ORM\Column(name="date_arrivee_en_france", type="date", nullable=true)
     */
    private $dateArriveeEnFrance;

    /**
     * @var boolean $scolariseYn
     *
     * @ORM\Column(name="scolarise_yn", type="boolean", nullable=true)
     */
    private $scolariseYn;

    /**
     * @var string $profession
     *
     * @ORM\Column(name="profession", type="string", length=45, nullable=true)
     */
    private $profession;

    /**
     * @var boolean $scolariseEnFranceYn
     *
     * @ORM\Column(name="scolarise_en_france_yn", type="boolean", nullable=true)
     */
    private $scolariseEnFranceYn;

    /**
     * @var boolean $scolariseEtrangerYn
     *
     * @ORM\Column(name="scolarise_etranger_yn", type="boolean", nullable=true)
     */
    private $scolariseEtrangerYn;

    /**
     * @var boolean $niveauScolarisation
     *
     * @ORM\Column(name="niveau_scolarisation", type="boolean", nullable=true)
     */
    private $niveauScolarisation;

    /**
     * @var boolean $formationLinguistiqueYn
     *
     * @ORM\Column(name="formation_linguistique_yn", type="boolean", nullable=true)
     */
    private $formationLinguistiqueYn;

    /**
     * @var text $typeFormationLinguistique
     *
     * @ORM\Column(name="type_formation_linguistique", type="text", nullable=true)
     */
    private $typeFormationLinguistique;

    /**
     * @var string $structureFormationLinguistique
     *
     * @ORM\Column(name="structure_formation_linguistique", type="string", length=50, nullable=true)
     */
    private $structureFormationLinguistique;

    /**
     * @var string $nomContactUrgence
     *
     * @ORM\Column(name="nom_contact_urgence", type="string", length=45, nullable=true)
     */
    private $nomContactUrgence;

    /**
     * @var string $prenomContactUrgence
     *
     * @ORM\Column(name="prenom_contact_urgence", type="string", length=45, nullable=true)
     */
    private $prenomContactUrgence;

    /**
     * @var string $telephoneContactUrgence
     *
     * @ORM\Column(name="telephone_contact_urgence", type="string", length=45, nullable=true)
     */
    private $telephoneContactUrgence;

    /**
     * @var string $lienParenteContactUrgence
     *
     * @ORM\Column(name="lien_parente_contact_urgence", type="string", length=45, nullable=true)
     */
    private $lienParenteContactUrgence;

    /**
     * @var RaisonsApprentissage
     *
     * @ORM\ManyToMany(targetEntity="RaisonsApprentissage", mappedBy="fkApprenant")
     */
    private $fkRaisonApprentissage;

    /**
     * @var Seances
     *
     * @ORM\ManyToMany(targetEntity="Seances", inversedBy="fkApprenant")
     * @ORM\JoinTable(name="a_participe_a",
     *   joinColumns={
     *     @ORM\JoinColumn(name="fk_id_apprenant", referencedColumnName="id_apprenant")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="fk_id_seance", referencedColumnName="id_seance")
     *   }
     * )
     */
    private $fkSeance;

    /**
     * @var Cours
     *
     * @ORM\ManyToMany(targetEntity="Cours", inversedBy="fkApprenant")
     * @ORM\JoinTable(name="est_inscrit_a",
     *   joinColumns={
     *     @ORM\JoinColumn(name="fk_id_apprenant", referencedColumnName="id_apprenant")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="fk_id_cours", referencedColumnName="id_cours")
     *   }
     * )
     */
    private $fkCours;

    /**
     * @var Langues
     *
     * @ORM\ManyToMany(targetEntity="Langues", mappedBy="fkApprenant")
     */
    private $fkLangue;

    /**
     * @var Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_pays_naissance", referencedColumnName="id_pays")
     * })
     */
    private $fkPaysNaissance;

    /**
     * @var Formateurs
     *
     * @ORM\ManyToOne(targetEntity="Formateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_accueilli_par_id_formateur", referencedColumnName="id_formateur")
     * })
     */
    private $fkAccueilliParFormateur;

    /**
     * @var Langues
     *
     * @ORM\ManyToOne(targetEntity="Langues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_langue_scolarisation", referencedColumnName="id_langue")
     * })
     */
    private $fkLangueScolarisation;

    /**
     * @var Langues
     *
     * @ORM\ManyToOne(targetEntity="Langues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_langue_maternelle", referencedColumnName="id_langue")
     * })
     */
    private $fkLangueMaternelle;

    /**
     * @var Niveaux
     *
     * @ORM\ManyToOne(targetEntity="Niveaux")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_niveau_propose", referencedColumnName="id_niveau")
     * })
     */
    private $fkNiveauPropose;

    public function __construct()
    {
        $this->fkRaisonApprentissage = new \Doctrine\Common\Collections\ArrayCollection();
    $this->fkSeance = new \Doctrine\Common\Collections\ArrayCollection();
    $this->fkCours = new \Doctrine\Common\Collections\ArrayCollection();
    $this->fkLangue = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idApprenant
     *
     * @return integer 
     */
    public function getIdApprenant()
    {
        return $this->idApprenant;
    }

    /**
     * Set dateMiseAJour
     *
     * @param datetime $dateMiseAJour
     */
    public function setDateMiseAJour($dateMiseAJour)
    {
        $this->dateMiseAJour = $dateMiseAJour;
    }

    /**
     * Get dateMiseAJour
     *
     * @return datetime 
     */
    public function getDateMiseAJour()
    {
        return $this->dateMiseAJour;
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
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set nomApprenant
     *
     * @param string $nomApprenant
     */
    public function setNomApprenant($nomApprenant)
    {
        $this->nomApprenant = $nomApprenant;
    }

    /**
     * Get nomApprenant
     *
     * @return string 
     */
    public function getNomApprenant()
    {
        return $this->nomApprenant;
    }

    /**
     * Set prenomApprenant
     *
     * @param string $prenomApprenant
     */
    public function setPrenomApprenant($prenomApprenant)
    {
        $this->prenomApprenant = $prenomApprenant;
    }

    /**
     * Get prenomApprenant
     *
     * @return string 
     */
    public function getPrenomApprenant()
    {
        return $this->prenomApprenant;
    }

    /**
     * Set dateDeNaissance
     *
     * @param date $dateDeNaissance
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    /**
     * Get dateDeNaissance
     *
     * @return date 
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * Set telFixeApprenant
     *
     * @param string $telFixeApprenant
     */
    public function setTelFixeApprenant($telFixeApprenant)
    {
        $this->telFixeApprenant = $telFixeApprenant;
    }

    /**
     * Get telFixeApprenant
     *
     * @return string 
     */
    public function getTelFixeApprenant()
    {
        return $this->telFixeApprenant;
    }

    /**
     * Set telPortableApprenant
     *
     * @param string $telPortableApprenant
     */
    public function setTelPortableApprenant($telPortableApprenant)
    {
        $this->telPortableApprenant = $telPortableApprenant;
    }

    /**
     * Get telPortableApprenant
     *
     * @return string 
     */
    public function getTelPortableApprenant()
    {
        return $this->telPortableApprenant;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * Get codePostal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
    }

    /**
     * Get nationalite
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set situationFamiliale
     *
     * @param string $situationFamiliale
     */
    public function setSituationFamiliale($situationFamiliale)
    {
        $this->situationFamiliale = $situationFamiliale;
    }

    /**
     * Get situationFamiliale
     *
     * @return string 
     */
    public function getSituationFamiliale()
    {
        return $this->situationFamiliale;
    }

    /**
     * Set commentaires
     *
     * @param text $commentaires
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    }

    /**
     * Get commentaires
     *
     * @return text 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set dateInscription
     *
     * @param date $dateInscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * Get dateInscription
     *
     * @return date 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set cheminPhoto
     *
     * @param string $cheminPhoto
     */
    public function setCheminPhoto($cheminPhoto)
    {
        $this->cheminPhoto = $cheminPhoto;
    }

    /**
     * Get cheminPhoto
     *
     * @return string 
     */
    public function getCheminPhoto()
    {
        return $this->cheminPhoto;
    }

    /**
     * Set communicationOrale
     *
     * @param boolean $communicationOrale
     */
    public function setCommunicationOrale($communicationOrale)
    {
        $this->communicationOrale = $communicationOrale;
    }

    /**
     * Get communicationOrale
     *
     * @return boolean 
     */
    public function getCommunicationOrale()
    {
        return $this->communicationOrale;
    }

    /**
     * Set dateArriveeEnFrance
     *
     * @param date $dateArriveeEnFrance
     */
    public function setDateArriveeEnFrance($dateArriveeEnFrance)
    {
        $this->dateArriveeEnFrance = $dateArriveeEnFrance;
    }

    /**
     * Get dateArriveeEnFrance
     *
     * @return date 
     */
    public function getDateArriveeEnFrance()
    {
        return $this->dateArriveeEnFrance;
    }

    /**
     * Set scolariseYn
     *
     * @param boolean $scolariseYn
     */
    public function setScolariseYn($scolariseYn)
    {
        $this->scolariseYn = $scolariseYn;
    }

    /**
     * Get scolariseYn
     *
     * @return boolean 
     */
    public function getScolariseYn()
    {
        return $this->scolariseYn;
    }

    /**
     * Set profession
     *
     * @param string $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * Get profession
     *
     * @return string 
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set scolariseEnFranceYn
     *
     * @param boolean $scolariseEnFranceYn
     */
    public function setScolariseEnFranceYn($scolariseEnFranceYn)
    {
        $this->scolariseEnFranceYn = $scolariseEnFranceYn;
    }

    /**
     * Get scolariseEnFranceYn
     *
     * @return boolean 
     */
    public function getScolariseEnFranceYn()
    {
        return $this->scolariseEnFranceYn;
    }

    /**
     * Set scolariseEtrangerYn
     *
     * @param boolean $scolariseEtrangerYn
     */
    public function setScolariseEtrangerYn($scolariseEtrangerYn)
    {
        $this->scolariseEtrangerYn = $scolariseEtrangerYn;
    }

    /**
     * Get scolariseEtrangerYn
     *
     * @return boolean 
     */
    public function getScolariseEtrangerYn()
    {
        return $this->scolariseEtrangerYn;
    }

    /**
     * Set niveauScolarisation
     *
     * @param boolean $niveauScolarisation
     */
    public function setNiveauScolarisation($niveauScolarisation)
    {
        $this->niveauScolarisation = $niveauScolarisation;
    }

    /**
     * Get niveauScolarisation
     *
     * @return boolean 
     */
    public function getNiveauScolarisation()
    {
        return $this->niveauScolarisation;
    }

    /**
     * Set formationLinguistiqueYn
     *
     * @param boolean $formationLinguistiqueYn
     */
    public function setFormationLinguistiqueYn($formationLinguistiqueYn)
    {
        $this->formationLinguistiqueYn = $formationLinguistiqueYn;
    }

    /**
     * Get formationLinguistiqueYn
     *
     * @return boolean 
     */
    public function getFormationLinguistiqueYn()
    {
        return $this->formationLinguistiqueYn;
    }

    /**
     * Set typeFormationLinguistique
     *
     * @param text $typeFormationLinguistique
     */
    public function setTypeFormationLinguistique($typeFormationLinguistique)
    {
        $this->typeFormationLinguistique = $typeFormationLinguistique;
    }

    /**
     * Get typeFormationLinguistique
     *
     * @return text 
     */
    public function getTypeFormationLinguistique()
    {
        return $this->typeFormationLinguistique;
    }

    /**
     * Set structureFormationLinguistique
     *
     * @param string $structureFormationLinguistique
     */
    public function setStructureFormationLinguistique($structureFormationLinguistique)
    {
        $this->structureFormationLinguistique = $structureFormationLinguistique;
    }

    /**
     * Get structureFormationLinguistique
     *
     * @return string 
     */
    public function getStructureFormationLinguistique()
    {
        return $this->structureFormationLinguistique;
    }

    /**
     * Set nomContactUrgence
     *
     * @param string $nomContactUrgence
     */
    public function setNomContactUrgence($nomContactUrgence)
    {
        $this->nomContactUrgence = $nomContactUrgence;
    }

    /**
     * Get nomContactUrgence
     *
     * @return string 
     */
    public function getNomContactUrgence()
    {
        return $this->nomContactUrgence;
    }

    /**
     * Set prenomContactUrgence
     *
     * @param string $prenomContactUrgence
     */
    public function setPrenomContactUrgence($prenomContactUrgence)
    {
        $this->prenomContactUrgence = $prenomContactUrgence;
    }

    /**
     * Get prenomContactUrgence
     *
     * @return string 
     */
    public function getPrenomContactUrgence()
    {
        return $this->prenomContactUrgence;
    }

    /**
     * Set telephoneContactUrgence
     *
     * @param string $telephoneContactUrgence
     */
    public function setTelephoneContactUrgence($telephoneContactUrgence)
    {
        $this->telephoneContactUrgence = $telephoneContactUrgence;
    }

    /**
     * Get telephoneContactUrgence
     *
     * @return string 
     */
    public function getTelephoneContactUrgence()
    {
        return $this->telephoneContactUrgence;
    }

    /**
     * Set lienParenteContactUrgence
     *
     * @param string $lienParenteContactUrgence
     */
    public function setLienParenteContactUrgence($lienParenteContactUrgence)
    {
        $this->lienParenteContactUrgence = $lienParenteContactUrgence;
    }

    /**
     * Get lienParenteContactUrgence
     *
     * @return string 
     */
    public function getLienParenteContactUrgence()
    {
        return $this->lienParenteContactUrgence;
    }

    /**
     * Add fkRaisonApprentissage
     *
     * @param Virgule\Bundle\MainBundle\Entity\RaisonsApprentissage $fkRaisonApprentissage
     */
    public function addRaisonsApprentissage(\Virgule\Bundle\MainBundle\Entity\RaisonsApprentissage $fkRaisonApprentissage)
    {
        $this->fkRaisonApprentissage[] = $fkRaisonApprentissage;
    }

    /**
     * Get fkRaisonApprentissage
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFkRaisonApprentissage()
    {
        return $this->fkRaisonApprentissage;
    }

    /**
     * Add fkSeance
     *
     * @param Virgule\Bundle\MainBundle\Entity\Seances $fkSeance
     */
    public function addSeances(\Virgule\Bundle\MainBundle\Entity\Seances $fkSeance)
    {
        $this->fkSeance[] = $fkSeance;
    }

    /**
     * Get fkSeance
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFkSeance()
    {
        return $this->fkSeance;
    }

    /**
     * Add fkCours
     *
     * @param Virgule\Bundle\MainBundle\Entity\Cours $fkCours
     */
    public function addCours(\Virgule\Bundle\MainBundle\Entity\Cours $fkCours)
    {
        $this->fkCours[] = $fkCours;
    }

    /**
     * Get fkCours
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFkCours()
    {
        return $this->fkCours;
    }

    /**
     * Add fkLangue
     *
     * @param Virgule\Bundle\MainBundle\Entity\Langues $fkLangue
     */
    public function addLangues(\Virgule\Bundle\MainBundle\Entity\Langues $fkLangue)
    {
        $this->fkLangue[] = $fkLangue;
    }

    /**
     * Get fkLangue
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFkLangue()
    {
        return $this->fkLangue;
    }

    /**
     * Set fkPaysNaissance
     *
     * @param Virgule\Bundle\MainBundle\Entity\Pays $fkPaysNaissance
     */
    public function setFkPaysNaissance(\Virgule\Bundle\MainBundle\Entity\Pays $fkPaysNaissance)
    {
        $this->fkPaysNaissance = $fkPaysNaissance;
    }

    /**
     * Get fkPaysNaissance
     *
     * @return Virgule\Bundle\MainBundle\Entity\Pays 
     */
    public function getFkPaysNaissance()
    {
        return $this->fkPaysNaissance;
    }

    /**
     * Set fkAccueilliParFormateur
     *
     * @param Virgule\Bundle\MainBundle\Entity\Formateurs $fkAccueilliParFormateur
     */
    public function setFkAccueilliParFormateur(\Virgule\Bundle\MainBundle\Entity\Formateurs $fkAccueilliParFormateur)
    {
        $this->fkAccueilliParFormateur = $fkAccueilliParFormateur;
    }

    /**
     * Get fkAccueilliParFormateur
     *
     * @return Virgule\Bundle\MainBundle\Entity\Formateurs 
     */
    public function getFkAccueilliParFormateur()
    {
        return $this->fkAccueilliParFormateur;
    }

    /**
     * Set fkLangueScolarisation
     *
     * @param Virgule\Bundle\MainBundle\Entity\Langues $fkLangueScolarisation
     */
    public function setFkLangueScolarisation(\Virgule\Bundle\MainBundle\Entity\Langues $fkLangueScolarisation)
    {
        $this->fkLangueScolarisation = $fkLangueScolarisation;
    }

    /**
     * Get fkLangueScolarisation
     *
     * @return Virgule\Bundle\MainBundle\Entity\Langues 
     */
    public function getFkLangueScolarisation()
    {
        return $this->fkLangueScolarisation;
    }

    /**
     * Set fkLangueMaternelle
     *
     * @param Virgule\Bundle\MainBundle\Entity\Langues $fkLangueMaternelle
     */
    public function setFkLangueMaternelle(\Virgule\Bundle\MainBundle\Entity\Langues $fkLangueMaternelle)
    {
        $this->fkLangueMaternelle = $fkLangueMaternelle;
    }

    /**
     * Get fkLangueMaternelle
     *
     * @return Virgule\Bundle\MainBundle\Entity\Langues 
     */
    public function getFkLangueMaternelle()
    {
        return $this->fkLangueMaternelle;
    }

    /**
     * Set fkNiveauPropose
     *
     * @param Virgule\Bundle\MainBundle\Entity\Niveaux $fkNiveauPropose
     */
    public function setFkNiveauPropose(\Virgule\Bundle\MainBundle\Entity\Niveaux $fkNiveauPropose)
    {
        $this->fkNiveauPropose = $fkNiveauPropose;
    }

    /**
     * Get fkNiveauPropose
     *
     * @return Virgule\Bundle\MainBundle\Entity\Niveaux 
     */
    public function getFkNiveauPropose()
    {
        return $this->fkNiveauPropose;
    }
}