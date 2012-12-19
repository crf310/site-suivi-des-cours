<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclEntries
 *
 * @ORM\Table(name="acl_entries")
 * @ORM\Entity
 */
class AclEntries
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="field_name", type="string", length=50, nullable=true)
     */
    private $fieldName;

    /**
     * @var integer
     *
     * @ORM\Column(name="ace_order", type="smallint", nullable=false)
     */
    private $aceOrder;

    /**
     * @var integer
     *
     * @ORM\Column(name="mask", type="integer", nullable=false)
     */
    private $mask;

    /**
     * @var boolean
     *
     * @ORM\Column(name="granting", type="boolean", nullable=false)
     */
    private $granting;

    /**
     * @var string
     *
     * @ORM\Column(name="granting_strategy", type="string", length=30, nullable=false)
     */
    private $grantingStrategy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="audit_success", type="boolean", nullable=false)
     */
    private $auditSuccess;

    /**
     * @var boolean
     *
     * @ORM\Column(name="audit_failure", type="boolean", nullable=false)
     */
    private $auditFailure;

    /**
     * @var \AclSecurityIdentities
     *
     * @ORM\ManyToOne(targetEntity="AclSecurityIdentities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="security_identity_id", referencedColumnName="id")
     * })
     */
    private $securityentity;

    /**
     * @var \AclObjectIdentities
     *
     * @ORM\ManyToOne(targetEntity="AclObjectIdentities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_identity_id", referencedColumnName="id")
     * })
     */
    private $objectentity;

    /**
     * @var \AclClasses
     *
     * @ORM\ManyToOne(targetEntity="AclClasses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     * })
     */
    private $class;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fieldName
     *
     * @param string $fieldName
     * @return AclEntries
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
    
        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string 
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set aceOrder
     *
     * @param integer $aceOrder
     * @return AclEntries
     */
    public function setAceOrder($aceOrder)
    {
        $this->aceOrder = $aceOrder;
    
        return $this;
    }

    /**
     * Get aceOrder
     *
     * @return integer 
     */
    public function getAceOrder()
    {
        return $this->aceOrder;
    }

    /**
     * Set mask
     *
     * @param integer $mask
     * @return AclEntries
     */
    public function setMask($mask)
    {
        $this->mask = $mask;
    
        return $this;
    }

    /**
     * Get mask
     *
     * @return integer 
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * Set granting
     *
     * @param boolean $granting
     * @return AclEntries
     */
    public function setGranting($granting)
    {
        $this->granting = $granting;
    
        return $this;
    }

    /**
     * Get granting
     *
     * @return boolean 
     */
    public function getGranting()
    {
        return $this->granting;
    }

    /**
     * Set grantingStrategy
     *
     * @param string $grantingStrategy
     * @return AclEntries
     */
    public function setGrantingStrategy($grantingStrategy)
    {
        $this->grantingStrategy = $grantingStrategy;
    
        return $this;
    }

    /**
     * Get grantingStrategy
     *
     * @return string 
     */
    public function getGrantingStrategy()
    {
        return $this->grantingStrategy;
    }

    /**
     * Set auditSuccess
     *
     * @param boolean $auditSuccess
     * @return AclEntries
     */
    public function setAuditSuccess($auditSuccess)
    {
        $this->auditSuccess = $auditSuccess;
    
        return $this;
    }

    /**
     * Get auditSuccess
     *
     * @return boolean 
     */
    public function getAuditSuccess()
    {
        return $this->auditSuccess;
    }

    /**
     * Set auditFailure
     *
     * @param boolean $auditFailure
     * @return AclEntries
     */
    public function setAuditFailure($auditFailure)
    {
        $this->auditFailure = $auditFailure;
    
        return $this;
    }

    /**
     * Get auditFailure
     *
     * @return boolean 
     */
    public function getAuditFailure()
    {
        return $this->auditFailure;
    }

    /**
     * Set securityentity
     *
     * @param \Virgule\Bundle\MainBundle\Entity\AclSecurityIdentities $securityentity
     * @return AclEntries
     */
    public function setSecurityentity(\Virgule\Bundle\MainBundle\Entity\AclSecurityIdentities $securityentity = null)
    {
        $this->securityentity = $securityentity;
    
        return $this;
    }

    /**
     * Get securityentity
     *
     * @return \Virgule\Bundle\MainBundle\Entity\AclSecurityIdentities 
     */
    public function getSecurityentity()
    {
        return $this->securityentity;
    }

    /**
     * Set objectentity
     *
     * @param \Virgule\Bundle\MainBundle\Entity\AclObjectIdentities $objectentity
     * @return AclEntries
     */
    public function setObjectentity(\Virgule\Bundle\MainBundle\Entity\AclObjectIdentities $objectentity = null)
    {
        $this->objectentity = $objectentity;
    
        return $this;
    }

    /**
     * Get objectentity
     *
     * @return \Virgule\Bundle\MainBundle\Entity\AclObjectIdentities 
     */
    public function getObjectentity()
    {
        return $this->objectentity;
    }

    /**
     * Set class
     *
     * @param \Virgule\Bundle\MainBundle\Entity\AclClasses $class
     * @return AclEntries
     */
    public function setClass(\Virgule\Bundle\MainBundle\Entity\AclClasses $class = null)
    {
        $this->class = $class;
    
        return $this;
    }

    /**
     * Get class
     *
     * @return \Virgule\Bundle\MainBundle\Entity\AclClasses 
     */
    public function getClass()
    {
        return $this->class;
    }
}