<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\ClassSession;

class ClassSessionManager extends BaseManager {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository('VirguleMainBundle:ClassSession');
    }
    
    public function isClassSessionAlreadyExisting($classSession) {

        if ($this->getRepository()->getNumberOfClassSessionsPerCourseAndDate($classSession->getCourse(), $classSession->getSessionDate()) > 0) {
            $classSessionExists = true;
        } else {
            $classSessionExists = false;
        }
        return $classSessionExists;
    }
}

?>
