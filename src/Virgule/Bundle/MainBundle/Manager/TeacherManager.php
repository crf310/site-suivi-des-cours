<?php
 
namespace Virgule\Bundle\MainBundle\Manager;
 
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\Teacher;
 
class TeacherManager extends BaseManager {
    
    protected $em;   
    
    private $container;

    public function __construct(EntityManager $em, ContainerInterface $container) {
        $this->em = $em;
        $this->container = $container;
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
    
    /**
     * This method is used whenever an account is locked, disabled, or with expired credentials
     * to reactive it
     * It sets a generated temporary password
     * @param \Virgule\Bundle\MainBundle\Entity\Teacher $teacherId
     */
    public function reactivateAccount(Teacher $teacher) {
        $teacher->setLocked(false);
        $teacher->setCredentialsExpired(false);
        $teacher->setEnabled(true);
                     
        $temporary_password = $this->generatePassword();
        $teacher->setPlainPassword($temporary_password);
        
        $expirationDate = new \DateTime("now");
        $tempCredentialsDays = $this->container->getParameter('temporary_credentials_days');
        $expirationDate->modify('+' . $tempCredentialsDays . ' day');
        $teacher->setCredentialsExpireAt($expirationDate);
        parent::persistAndFlush($teacher);
        
        return $temporary_password;
    }
    
    public function generatePassword() {
        $tokenGenerator = $this->container->get('fos_user.util.token_generator');
        $temporary_password = substr($tokenGenerator->generateToken(), 0, 8);
        return $temporary_password;
    }
}

?>