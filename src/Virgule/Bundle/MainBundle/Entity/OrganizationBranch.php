<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\OrganizationBranch
 *
 * @ORM\Table(name="organization_branch")
 * @ORM\Entity
 */
class OrganizationBranch
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=250, nullable=true)
     */
    private $address;

    /**
     * @var string $presidentName
     *
     * @ORM\Column(name="president_name", type="string", length=100, nullable=false)
     */
    private $presidentName;

    /**
     * @var string $phoneNumber
     *
     * @ORM\Column(name="phone_number", type="string", length=10, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string $faxNumber
     *
     * @ORM\Column(name="fax_number", type="string", length=10, nullable=true)
     */
    private $faxNumber;

    /**
     * @var string $emailAddress
     *
     * @ORM\Column(name="email_address", type="string", length=45, nullable=true)
     */
    private $emailAddress;


}
