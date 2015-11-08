<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of VirguleController
 *
 * @author guillaume
 */
abstract class AbstractVirguleController extends Controller {

  protected function addFlash($message, $type = 'success') {
    $this->get('session')->getFlashBag()->add($type, $message);
  }

  protected function logInfo($message) {
    $user = $this->getConnectedUser();
    $logger = $this->get('logger');
    $logMsg = $user->getFirstname() . ' ' . $user->getLastname() . ' - ' . $message;
    $logger->info($logMsg);
  }

  protected function logDebug($message) {
    $logger = $this->get('logger');
    $logger->debug($message);
  }

  protected function logError($message) {
    $logger = $this->get('logger');
    $logger->error($message);
  }

  protected function paginate($entities, $page = 1) {
    $pagerfanta = new Pagerfanta(new ArrayAdapter($entities));
    $pagerfanta->setMaxPerPage($this->container->parameters['pager_nb_results']);

    try {
      $pagerfanta->setCurrentPage($page);
    } catch (NotValidCurrentPageException $e) {
      throw new NotFoundHttpException();
    }

    return array('entities' => $pagerfanta);
  }

  protected function getDoctrineManager() {
    return $em = $this->getDoctrine()->getManager();
  }

  protected function getConnectedUser() {
    return $this->get('security.context')->getToken()->getUser();
  }

  protected function getSelectedSemesterId() {
    return $this->getRequest()->getSession()->get('currentSemester')->getId();
  }

  protected function getSelectedSemester() {
    $currentSemesterId = $this->getSelectedSemesterId();
    $semesterRepository = $this->getSemesterRepository();
    $semester = $semesterRepository->find($currentSemesterId);
    return $semester;
  }

  protected function getSelectedOrganizationBranchId() {
    return $this->getRequest()->getSession()->get('organizationBranch')->getId();
  }

  protected function getSelectedOrganizationBranch() {
    $obRepository = $this->getOrganizationBranchRepository();
    $organizationBranchId = $this->getSelectedOrganizationBranchId();
    $organizationBranch = $obRepository->find($organizationBranchId);
    return $organizationBranch;
  }

  protected function getListBreak($count, $break = 2) {
    return (int) ($count / $break) + $count % $break;
  }

  /* Managers */
  protected function getCourseManager() {
    return $this->get('virgule.course_manager');
  }

  protected function getTeacherManager() {
    return $this->get('virgule.teacher_manager');
  }

  protected function getSemesterManager() {
    return $this->get('virgule.semester_manager');
  }

  protected function getOpenHouseManager() {
    return $this->get('virgule.openhouse_manager');
  }

  protected function getStudentManager() {
    return $this->get('virgule.student_manager');
  }

  protected function getDocumentManager() {
    return $this->get('virgule.document_manager');
  }

  protected function getTagManager() {
    return $this->get('virgule.tag_manager');
  }

  protected function getHelpManager() {
    return $this->get('virgule.help_manager');
  }

  /* Repositories */

  private function getDoctrineRepository($entityName) {
    return $this->getDoctrineManager()->getRepository('VirguleMainBundle:' . $entityName);
  }

  protected function getTeacherRepository() {
    $this->getDoctrineRepository('Teacher');
  }

  protected function getStudentRepository() {
    $this->getDoctrineRepository('Student');
  }

  protected function getCourseRepository() {
    $this->getDoctrineRepository('Course');
  }

  protected function getOpenHouseRepository() {
    $this->getDoctrineRepository('OpenHouse');
  }

  protected function getCountryRepository() {
    $this->getDoctrineRepository('Country');
  }

  protected function getClassRoomRepository() {
    $this->getDoctrineRepository('ClassRoom');
  }

  protected function getClassLevelRepository() {
    $this->getDoctrineRepository('ClassLevel');
  }

  protected function getClassLevelSuggestedRepository() {
    $this->getDoctrineRepository('ClassLevelSuggested');
  }

  protected function getClassSessionRepository() {
    $this->getDoctrineRepository('ClassSession');
  }

  protected function getTagRepository() {
    $this->getDoctrineRepository('Tag');
  }

  protected function getLanguageRepository() {
    $this->getDoctrineRepository('Language');
  }

  protected function getDocumentRepository() {
    $this->getDoctrineRepository('Document');
  }
  
  protected function getOrganizationBranchRepository() {
    $this->getDoctrineRepository('OrganizationBranch');
  }
  
  protected function getSemesterRepository() {
    $this->getDoctrineRepository('Semester');
  }

}

?>
