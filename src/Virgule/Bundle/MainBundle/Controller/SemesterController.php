<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Semester;
use Virgule\Bundle\MainBundle\Entity\OpenHouse;
use Virgule\Bundle\MainBundle\Form\Type\SemesterType;
use Virgule\Bundle\MainBundle\Form\Type\OpenHouseType;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Virgule\Bundle\MainBundle\StoreEvents;
use Virgule\Bundle\MainBundle\Event\NewSemesterEvent;

/**
 * Semester controller.
 *
 * @Route("/semester")
 */
class SemesterController extends AbstractVirguleController {

  /**
   * Load selected semester info into session
   *
   * @Route("/{id}/switch", name="semester_switch")
   * @Template()
   */
  public function switchAction($id) {
    $semesters = $this->getSemesterManager()->setSelectedSemesterAsCurrent($id);

    return $this->redirect($this->generateUrl('welcome'));
  }

  /**
   * Lists all Semester entities.
   *
   * @Route("/", name="semester_index")
   * @Template()
   */
  public function indexAction() {
    $semesters = $this->getSemesterManager()->loadAllSemestersForBranch($this->getSelectedOrganizationBranchId());

    $openHouses = $this->getOpenHouseManager()->getOpenHouses($this->getSelectedSemesterId());

    $openHouseEntity = new OpenHouse();
    $openHouseForm = $this->createForm(new OpenHouseType(), $openHouseEntity);

    return array_merge(array(
        'semesters' => $semesters,
        'openHouses' => $openHouses,
        'openHouseEntity' => $openHouseEntity,
        'openHouseForm' => $openHouseForm->createView(),
            ), $this->newAction());
  }

  /**
   * Finds and displays a Semester entity.
   *
   * @Route("/{id}/show", name="semester_show")
   * @Template()
   */
  public function showAction($id) {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('VirguleMainBundle:Semester')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Semester entity.');
    }
    
    return array(
        'entity' => $entity,
    );
  }

  /**
   * Displays a form to create a new Semester entity.
   *
   * @Route("/new", name="semester_new")
   * @Template()
   */
  public function newAction() {
    $entity = new Semester();
    $form = $this->createForm(new SemesterType(), $entity);

    $courses = $this->getCourseManager()->getAllHydratedCourses($this->getSelectedSemesterId());

    return array(
        'courses' => $courses,
        'semesterEntity' => $entity,
        'semesterForm' => $form->createView(),
    );
  }

  /**
   * Creates a new Semester entity.
   *
   * @Route("/create", name="semester_create")
   * @Method("POST")
   * @Template("VirguleMainBundle:Semester:new.html.twig")
   */
  public function createAction(Request $request) {
    $entity = new Semester();
    $entity->setOrganizationBranch($this->getSelectedOrganizationBranch());
    $form = $this->createForm(new SemesterType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      // suspend auto-commit
      $em->getConnection()->beginTransaction();
      // Try and make the transaction
      try {
        $em->persist($entity);
        $em->flush();

        $flashMessage = 'Nouveau semestre créé avec succès !';

        if ($request->get('courses')) {
          $coursesToCopy = $request->get('courses');
          $nbCoursesToCopy = count($coursesToCopy);

          $this->getCourseManager()->cloneCourses($coursesToCopy, $entity);
          $flashMessage .= "&nbsp;<strong>" . $nbCoursesToCopy . '</strong> cours copiés.';
        }
        // Try and commit the transaction
        $em->getConnection()->commit();

        $this->getSemesterManager()->reloadAllSemestersIntoSession($this->getSelectedOrganizationBranchId());
        if ($this->getSemesterManager()->setNewSemesterAsCurrent($entity)) {
          $flashMessage .= '&nbsp;Vous avez été repositionné sur ce semestre';
        }
        $this->addFlash($flashMessage);

        return $this->redirect($this->generateUrl('semester_index'));
      } catch (Exception $e) {
        // Rollback the failed transaction attempt
        $em->getConnection()->rollback();
        $em->close();
        throw $e;
      }
    }

    $courses = $this->getCourseManager()->getAllHydratedCourses($this->getSelectedSemesterId());

    return array(
        'courses' => $courses,
        'semesterEntity' => $entity,
        'semesterForm' => $form->createView(),
    );
  }


}
