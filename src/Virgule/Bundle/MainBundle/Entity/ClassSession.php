<?php

namespace Virgule\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Virgule\Bundle\MainBundle\Entity\ClassSession
 *
 * @ORM\Table(name="class_session")
 * @ORM\Entity
 */
class ClassSession
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
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string $summary
     *
     * @ORM\Column(name="summary", type="text", nullable=true)
     */
    private $summary;

    /**
     * @var integer $fkClassId
     *
     * @ORM\Column(name="fk_class_id", type="integer", nullable=false)
     */
    private $fkClassId;

    /**
     * @var integer $fkSessionTeacherId
     *
     * @ORM\Column(name="fk_session_teacher_id", type="integer", nullable=false)
     */
    private $fkSessionTeacherId;

    /**
     * @var integer $fkSummaryTeacherId
     *
     * @ORM\Column(name="fk_summary_teacher_id", type="integer", nullable=false)
     */
    private $fkSummaryTeacherId;


}
