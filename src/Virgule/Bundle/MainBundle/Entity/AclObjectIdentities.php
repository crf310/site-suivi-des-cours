<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclObjectIdentities
 *
 * @ORM\Table(name="acl_object_identities")
 * @ORM\Entity
 */
class AclObjectIdentities
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
     * @var integer
     *
     * @ORM\Column(name="class_id", type="integer", nullable=false)
     */
    private $classId;

    /**
     * @var string
     *
     * @ORM\Column(name="object_identifier", type="string", length=100, nullable=false)
     */
    private $objectIdentifier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="entries_inheriting", type="boolean", nullable=false)
     */
    private $entriesInheriting;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AclObjectIdentities", mappedBy="ancestor")
     */
    private $objectentity;

    /**
     * @var \AclObjectIdentities
     *
     * @ORM\ManyToOne(targetEntity="AclObjectIdentities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_object_identity_id", referencedColumnName="id")
     * })
     */
    private $parentObjectentity;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->objectentity = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

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
     * Set classId
     *
     * @param integer $classId
     * @return AclObjectIdentities
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;
    
        return $this;
    }

    /**
     * Get classId
     *
     * @return integer 
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * Set objectIdentifier
     *
     * @param string $objectIdentifier
     * @return AclObjectIdentities
     */
    public function setObjectIdentifier($objectIdentifier)
    {
        $this->objectIdentifier = $objectIdentifier;
    
        return $this;
    }

    /**
     * Get objectIdentifier
     *
     * @return string 
     */
    public function getObjectIdentifier()
    {
        return $this->objectIdentifier;
    }

    /**
     * Set entriesInheriting
     *
     * @param boolean $entriesInheriting
     * @return AclObjectIdentities
     */
    public function setEntriesInheriting($entriesInheriting)
    {
        $this->entriesInheriting = $entriesInheriting;
    
        return $this;
    }

    /**
     * Get entriesInheriting
     *
     * @return boolean 
     */
    public function getEntriesInheriting()
    {
        return $this->entriesInheriting;
    }

    /**
     * Add objectentity
     *
     * @param \Virgule\Bundle\MainBundle\Entity\AclObjectIdentities $objectentity
     * @return AclObjectIdentities
     */
    public function addObjectentity(\Virgule\Bundle\MainBundle\Entity\AclObjectIdentities $objectentity)
    {
        $this->objectentity[] = $objectentity;
    
        return $this;
    }

    /**
     * Remove objectentity
     *
     * @param \Virgule\Bundle\MainBundle\Entity\AclObjectIdentities $objectentity
     */
    public function removeObjectentity(\Virgule\Bundle\MainBundle\Entity\AclObjectIdentities $objectentity)
    {
        $this->objectentity->removeElement($objectentity);
    }

    /**
     * Get objectentity
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getObjectentity()
    {
        return $this->objectentity;
    }

    /**
     * Set parentObjectentity
     *
     * @param \Virgule\Bundle\MainBundle\Entity\AclObjectIdentities $parentObjectentity
     * @return AclObjectIdentities
     */
    public function setParentObjectentity(\Virgule\Bundle\MainBundle\Entity\AclObjectIdentities $parentObjectentity = null)
    {
        $this->parentObjectentity = $parentObjectentity;
    
        return $this;
    }

    /**
     * Get parentObjectentity
     *
     * @return \Virgule\Bundle\MainBundle\Entity\AclObjectIdentities 
     */
    public function getParentObjectentity()
    {
        return $this->parentObjectentity;
    }
}