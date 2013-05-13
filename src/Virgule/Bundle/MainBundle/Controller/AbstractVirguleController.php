<?php
namespace Virgule\Bundle\MainBundle\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of VirguleController
 *
 * @author guillaume
 */
abstract class AbstractVirguleController extends Controller {
     
    protected function addFlash($message, $type='notice') {
         $this->get('session')->getFlashBag()->add($type, $message);
    }
    
    protected function logInfo($message) {
        $logger = $this->get('logger');
        $logger->info($message);
    }
    
    protected function logDebug($message) {
        $logger = $this->get('logger');
        $logger->debug($message);
    }
    
    protected function paginate($entities, $page=1) {
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
    
    protected function getSelectedSemesterId()  {
        return $this->getRequest()->getSession()->get('currentSemester')->getId();
    }
    
    protected function getSelectedSemester() {
        $currentSemesterId = $this->getSelectedSemesterId();
        $semesterRepository = $this->getDoctrineManager()->getRepository('VirguleMainBundle:Semester');
        $semester = $semesterRepository->find($currentSemesterId);
        return $semester;
    }
    
    protected function getSelectedOrganizationBranchId()  {
        return $this->getRequest()->getSession()->get('organizationBranch')->getId();
    }
    
    protected function getSelectedOrganizationBranch() {
        $obRepository = $this->getDoctrineManager()->getRepository('VirguleMainBundle:OrganizationBranch');
        $organizationBranchId = $this->getSelectedOrganizationBranchId();
        $organizationBranch = $obRepository->find($organizationBranchId);
        return $organizationBranch;
    }
    
    protected function getListBreak($count, $break=2) {
        return (int)($count / $break) + $count % $break;
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
    
    /* Repositories */
    protected function getTeacherRepository() {
        return $this->getDoctrineManager()->getRepository('VirguleMainBundle:Teacher');
    }
    protected function getStudentRepository() {
        return $this->getDoctrineManager()->getRepository('VirguleMainBundle:Student');
    }
    protected function getCourseRepository() {
        return $this->getDoctrineManager()->getRepository('VirguleMainBundle:Course');
    }
    protected function getOpenHouseRepository() {
        return $this->getDoctrineManager()->getRepository('VirguleMainBundle:OpenHouse');
    }
    protected function getCountryRepository() {
        return $this->getDoctrineManager()->getRepository('VirguleMainBundle:Country');
    }
    protected function getClassRoomRepository() {
        return $this->getDoctrineManager()->getRepository('VirguleMainBundle:ClassRoom');
    }
    protected function getClassLevelSuggestedRepository() {
        return $this->getDoctrineManager()->getRepository('VirguleMainBundle:ClassLevelSuggested');
    }
}

?>
