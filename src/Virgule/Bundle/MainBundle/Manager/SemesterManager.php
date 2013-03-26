<?php
 
namespace Virgule\Bundle\MainBundle\Manager;
 
use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\Semester;
 
class SemesterManager extends BaseManager {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getRepository() {
        return $this->em->getRepository('VirguleMainBundle:Semester');
    }
    
    public function loadCurrentSemester($organizationBranchId) {
        return $this->getRepository()->loadCurrentSemester($organizationBranchId);
    }   
    
    public function loadAllSemestersForBranch($organizationBranchId) {
        return $this->getRepository()->loadAll($organizationBranchId);
    }
    
    public function copyCourses() {
        
    }
}

?>