<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Course;
use Virgule\Bundle\MainBundle\Entity\Student;
use Virgule\Bundle\MainBundle\Entity\Planning\Planning;
use Virgule\Bundle\MainBundle\Form\CourseType;
use Virgule\Bundle\MainBundle\Form\SelectClassRoomType;
use Virgule\Bundle\MainBundle\Form\FormConstants;

/**
 * Course controller.
 *
 * @Route("/course")
 */
class CourseController extends AbstractVirguleController {

    private function getManager() {
        return $this->get('virgule.course_manager');
    }
        
    /**
     * Get number of students enrolled for each courses
     * @Route("/{courseId}/nbEnrolledStudents", name="course_get_nb_enrolledStudents", defaults={"_format": "json"}, options={"expose"=true})
     * * @Template("VirguleMainBundle:Course:numberOfEnrolledStudents.json.twig")
     */
    public function getNbEnrolledStudentsAction($courseId) {
        $courses = $this->getCourseManager()->getNumberOfEnrolledStudents(Array($courseId));
        return Array('courses' => $courses);
    }    
    
    /**
     * Enroll a student 
     * @Route("/{courseId}/enroll/{studentId}", name="course_enroll_student", options={"expose"=true})
     */
    public function enrollAction(Course $courseId, Student $studentId) {
        $result = $this->getCourseManager()->enrollmentAction($courseId, $studentId, true);
        return new Response();
    }    
    
    /**
     * Enroll a student 
     * @Route("/{courseId}/unenroll/{studentId}", name="course_unenroll_student", options={"expose"=true})
     */
    public function unenrollAction(Course $courseId, Student $studentId) {
        $result = $this->getCourseManager()->enrollmentAction($courseId, $studentId, false);
        return new Response();
    }
            
    /**
     *
     * @Route("/{id}/enrollments", name="course_manage_enrollments")
     * @Template("VirguleMainBundle:Course:manageEnrollments.html.twig")
     */
    public function manageEnrollmentsAction(Course $id) {
        $previousSemester = $this->getSemesterManager()->getPreviousSemester($this->getSelectedSemester());
        
        $teacherId = $this->getUser()->getId();
        $semesterId = $previousSemester->getId();
        $previousCourses = $this->getCourseRepository()->getCoursesByTeacher($semesterId, $teacherId);
        
        $studentsPerCourse = array();
        foreach ($previousCourses as $course) {
            $studentsPerCourse[$course->getId()] = $this->getStudentRepository()->loadAllEnrolledInCourse(array($course->getId()));
        }
        
        $currentEnrolledStudents = $this->getStudentRepository()->loadAllEnrolledInCourse(array($id));
        foreach ($currentEnrolledStudents as $currentStudent) {
            $currentEnrolledStudentsIds[$currentStudent['student_id']] = $currentStudent['student_id'];
        }
        
        return array(
            'course'                        => $id,
            'previousCourses'               => $previousCourses,
            'studentsPerCourse'             => $studentsPerCourse,
            'currentEnrolledStudentsIds'    => $currentEnrolledStudentsIds,
            'previousSemester'             => $previousSemester
        );
    }
    
    /**
     *
     * @Route("/{id}/trombi", name="course_show_trombinoscope")
     * @Template("VirguleMainBundle:Course:trombinoscope.web.html.twig")
     */
    public function showTrombinoscopeAction(Course $id) {    
        $enrolledStudents = $this->getStudentRepository()->loadAllEnrolledInCourseEntities($id->getId());

        return array(
            'enrolledStudents' => $enrolledStudents,
            'course' => $id,
        );
    }
    
    /**
     *
     * @Route("/{id}/printTrombi", name="course_print_trombinoscope"))
     * @Template("VirguleMainBundle:Course:trombinoscope.html.twig")
     */
    public function printTrombinoscopeAction(Course $id) {    
        $enrolledStudents = $this->getStudentRepository()->loadAllEnrolledInCourseEntities($id->getId());

        return array(
            'enrolledStudents' => $enrolledStudents,
            'course' => $id,
        );
    }
    
    /**
     *
     * @Route("/printPlanning", name="course_print_planning"))
     * @Method("GET")
     * @Template("VirguleMainBundle:Course:planning.print.html.twig")
     */
    public function printPlanningAction(Request $request) {
        $classRooms = $request->query->get('classRoomForm[classRoom]', null, true);
        // get classes from request
        $pdfGenerator = $this->get('siphoc.pdf.generator');
        $fileName = 'planning.pdf';
        $pdfGenerator->setName($fileName);
        return $pdfGenerator->downloadFromView(
            'VirguleMainBundle:Course:planning.print.html.twig',
            $this->generatePlanning(true, $classRooms),
            array('orientation' => 'landscape')
        );
        
    }
    
    /**
     * Lists all Course entities.
     *
     * @Route("/showPlanning", name="course_show_planning"))
     * @Template("VirguleMainBundle:Course:planning.web.html.twig")
     */
    public function showPlanningAction() {
        $selectClassRoomForm = $this->createForm(new SelectClassRoomType($this->getDoctrineManager(), $this->getSelectedOrganizationBranchId()));
        return array_merge(
                array('selectClassRoomForm' => $selectClassRoomForm->createView()),
                $this->generatePlanning()
                );
    }
    
    private function generatePlanning($forPrint = false, $classRoomIds = null) {
        $semesterId = $this->getSelectedSemesterId();
        
        $courses = $this->getCourseManager()->getAllHydratedCourses($semesterId, $classRoomIds);
        
        $planning = new Planning($courses, true);
        return Array('headerCells' => $planning->getHeader(), 'planningRows' => $planning->getRows(), 'forPrint' => $forPrint);
    }
    
    /**
     * Lists all Course entities.
     *
     * @Route("/", name="course_index")
     * @Template()
     */
    public function indexAction() {
        $semesterId = $this->getSelectedSemesterId();
        
        $courses = $this->getCourseManager()->getAllHydratedCourses($semesterId);
        $courseIds = Array();
        foreach ($courses as $course) {
            $courseIds[] = $course->getId();
        }
        
        $nbClassSessions = $this->getCourseRepository()->getNumberOfClassSessionsPerCourse($courseIds);
        return Array('courses' => $courses, 'nbClassSessions' => $nbClassSessions);
    }

    /**
     * Finds and displays a Course entity.
     *
     * @Route("/{id}/show", name="course_show")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->getCourseRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Course entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        $enrolledStudents = $this->getStudentRepository()->loadAllEnrolledInCourse($id);
        
        $classSessions = $this->getClassSessionRepository()->loadAllClassSessionByCourse($id);

        return array(
            'classSessions' => $classSessions,
            'enrolledStudents' => $enrolledStudents,
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Course entity.
     *
     * @Route("/new", name="course_new")
     * @Template()
     */
    public function newAction() {        
        $em = $this->getDoctrine()->getManager();
                
        $entity = new Course();
        $organizationBranchId = $this->getSelectedOrganizationBranch()->getId();
        $form = $this->createForm(new CourseType(FormConstants::CREATE_INTENTION, $organizationBranchId, $em), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Course entity.
     *
     * @Route("/create", name="course_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Course:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Course();
       
        $organizationBranch = $this->getSelectedOrganizationBranch();
        $entity->setOrganizationBranch($organizationBranch);
        $entity->setSemester($this->getSelectedSemester());
                        
        $em = $this->getDoctrine()->getManager();
               
        $form = $this->createForm(new CourseType(FormConstants::CREATE_INTENTION, $organizationBranch->getId(), $em), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->addFlash('Nouveau cours créé avec succès !');
            
            if ($request->get('save_and_add_new')) {
                return $this->redirect($this->generateUrl('course_new'));
            } else {
                return $this->redirect($this->generateUrl('course_show_planning'));
            }
        } else {
            
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Course entity.
     *
     * @Route("/{id}/edit", name="course_edit")
     * @Template()
     */
    public function editAction($id) {
        $entity = $this->getCourseRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Course entity.');
        }
                
        $editForm = $this->createForm(new CourseType(FormConstants::EDIT_INTENTION, $this->getSelectedOrganizationBranch()->getId(), $em), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Course entity.
     *
     * @Route("/{id}/update", name="course_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:Course:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $entity = $this->getCourseRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Course entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        $editForm = $this->createForm(new CourseType(FormConstants::EDIT_INTENTION, $this->getSelectedOrganizationBranch()->getId(), $em), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('course_show', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Course entity.
     *
     * @Route("/{id}/delete", name="course_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->getCourseRepository()->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Course entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('course_show_planning'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
    
}
