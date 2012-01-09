<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\LogActions
 *
 * @ORM\Table(name="log_actions")
 * @ORM\Entity
 */
class LogActions
{
    /**
     * @var integer $idAction
     *
     * @ORM\Column(name="id_action", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAction;

    /**
     * @var datetime $dateAction
     *
     * @ORM\Column(name="date_action", type="datetime", nullable=true)
     */
    private $dateAction;

    /**
     * @var text $message
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

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
     * Get idAction
     *
     * @return integer 
     */
    public function getIdAction()
    {
        return $this->idAction;
    }

    /**
     * Set dateAction
     *
     * @param datetime $dateAction
     */
    public function setDateAction($dateAction)
    {
        $this->dateAction = $dateAction;
    }

    /**
     * Get dateAction
     *
     * @return datetime 
     */
    public function getDateAction()
    {
        return $this->dateAction;
    }

    /**
     * Set message
     *
     * @param text $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
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
}