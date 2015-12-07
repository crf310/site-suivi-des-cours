<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\Semester;

class SemesterManager extends BaseManager {

  protected $em;
  private $request;

  public function __construct(EntityManager $em, Request $request) {
    $this->em = $em;
    $this->request = $request;
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

  public function reloadAllSemestersIntoSession($organizationBranchId) {
    $allSemesters = $this->loadAllSemestersForBranch($organizationBranchId);
    $session = $this->request->getSession();
    $session->set('allSemesters', $allSemesters);
    return true;
  }

  public function setSelectedSemesterAsCurrent($semesterId) {
    $semester = $this->getRepository()->find($semesterId);

    $session = $this->request->getSession();
    $session->set('currentSemester', $semester);
  }

  /**
   * Checks if newly created semester could be the current
   * if yes, sets it into session and returns true
   * @param \Virgule\Bundle\MainBundle\Entity\Semester $semester
   */
  public function setNewSemesterAsCurrent(Semester $semester) {
    $today = new \DateTime('now');
    if ($today >= $semester->getStartDate() && $today <= $semester->getEndDate()) {
      $session = $this->request->getSession();
      $session->set('currentSemester', $semester);
      return true;
    } else {
      return false;
    }
  }

  public function getPreviousSemester(Semester $currentSemester) {
    return $this->getRepository()->getPreviousSemester($currentSemester->getOrganizationBranch()->getId(), $currentSemester->getStartDate());
  }

}

?>
