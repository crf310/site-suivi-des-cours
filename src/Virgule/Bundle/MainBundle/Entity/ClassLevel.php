<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\ClassLevel
 *
 * @ORM\Table(name="class_level")
 * @ORM\Entity
 */
class ClassLevel
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
     * @var string $label
     *
     * @ORM\Column(name="label", type="string", length=20, nullable=true)
     */
    private $label;

    /**
     * @var string $htmlColorCode
     *
     * @ORM\Column(name="html_color_code", type="string", length=7, nullable=true)
     */
    private $htmlColorCode;


}
