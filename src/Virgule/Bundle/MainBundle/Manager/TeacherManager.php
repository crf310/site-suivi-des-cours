<?php
 
namespace Virgule\Bundle\MainBundle\Manager;
 
use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use Virgule\Bundle\MainBundle\Repository\TeacherRepository;
use \Virgule\Bundle\MainBundle\Entity\Teacher;
 
class TeacherManager extends BaseManager {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getRepository() {
        return $this->em->getRepository('VirguleMainBundle:TeacherRepository');
    }
    
    public function getActiveTeachers() {
       return $this->getRepository()->getTeacherByStatus(true);
    }
    
    public function getNonActiveTeachers() {
        return $this->getRepository()->getTeachersByStatus(false);
    }
    
    static public function updateLastConnectionDate(Teacher $teacher) {
        $teacher->setLastConnectionDate(time());
        parent::persistAndFlush($teacher);
    }
}

?>