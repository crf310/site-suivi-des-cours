<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\Teacher;
use \ Virgule\Bundle\MainBundle\Repository\TeacherRepository;

class TeacherManager extends BaseManager {

  protected $em;
  private $container;

  public function __construct(EntityManager $em, ContainerInterface $container) {
    $this->em = $em;
    $this->container = $container;
  }

  public function getRepository() {
    return $this->em->getRepository('VirguleMainBundle:Teacher');
  }

  public function getTeachersWithCoursesQueryBuilder($organizationBranchId, $semesterId) {
    $qb = $this->getRepository()
            ->getTeachers($organizationBranchId)
            ->innerJoin('t.courses', 'c')
            ->innerJoin('c.semester', 's', 'WITH', 's.id = :semesterId')
            ->setParameter('semesterId', $semesterId);
    return $qb;
  }

  public function getTeachersWithCourses($organizationBranchId, $semesterId) {
    return $this->getTeachersWithCoursesQueryBuilder($organizationBranchId, $semesterId)->getQuery()->execute();
  }

  public function getNumberOfTeachersWithCourses($organizationBranchId, $semesterId) {
    $qb = $this->getTeachersWithCoursesQueryBuilder($organizationBranchId, $semesterId);
    $qb->select('count(t.id)');
    return $qb->getQuery()->getSingleScalarResult();
  }

  public function getTeachersWithoutCoursesQueryBuilder($organizationBranchId, $semesterId) {
    $qb = $this->getRepository()
            ->getTeachers($organizationBranchId)
            ->leftJoin('t.courses', 'c')
            ->innerJoin('c.semester', 's', 'WITH', 's.id = :semesterId')
            ->setParameter('semesterId', $semesterId);
    return $qb;
  }

  public function getTeachersWithoutCourses($organizationBranchId, $semesterId) {
    return $this->getTeachersWithoutCoursesQueryBuilder($organizationBranchId, $semesterId)->getQuery()->execute();
  }

  public function getNumberOfTeachersWithoutCourses($organizationBranchId, $semesterId) {
    $qb = $this->getTeachersWithoutCoursesQueryBuilder($organizationBranchId, $semesterId);
    $qb->select('count(t.id)');
    return $qb->getQuery()->getSingleScalarResult();
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

    $credentialsExpirationDate = new \DateTime("now");
    $tempCredentialsDays = $this->container->getParameter('temporary_credentials_days');
    $credentialsExpirationDate->modify('+' . $tempCredentialsDays . ' day');
    $teacher->setCredentialsExpireAt($credentialsExpirationDate);

    $expirationDate = new \DateTime("now");
    $daysBeforeExpiration = $this->container->getParameter('user_account_days_before_expiration');
    $expirationDate->modify('+' . $daysBeforeExpiration . ' day');
    $teacher->setExpiresAt($expirationDate);

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
