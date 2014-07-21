<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Student;
use Virgule\Bundle\MainBundle\Entity\Comment;
use Virgule\Bundle\MainBundle\Entity\Course;
use Virgule\Bundle\MainBundle\Entity\ClassLevelSuggested;
use Virgule\Bundle\MainBundle\Form\StudentType;
use Virgule\Bundle\MainBundle\Form\CommentType;
use Virgule\Bundle\MainBundle\Form\ClassLevelSuggestedType;

/**
 * Student controller.
 *
 * @Route("/student")
 */
class StudentController extends AbstractVirguleController {
    
    /**
     * Search for a student on its partial name and firstname
     *
     * @Route("/search/{name}", name="student_search_name", defaults={"_format": "json"})
     * @Template("VirguleMainBundle:Student:searchResults.json.twig")
     */     
    public function searchAction($name) {
        $students = $this->getStudentRepository()->searchStudent($name);
            
        return Array('students' => $students);
    }
    
     /**
     * Preview the certificate of attendance in a web page
     *
     * @Route("/{id}/previewCertificate", name="student_preview_certificate")
     * @Template("VirguleMainBundle:Student:certificate.html.twig")
     */
    public function previewCertificate(Student $student) {
        $org_branch = $this->getSelectedOrganizationBranch();
        return Array('student' => $student, 'org_branch' => $org_branch, 'today' => new \DateTime('now'), 'preview' => 'true');
    }
    
    /**
     * 
     *
     * @Route("/{id}/generateCertificate", name="student_generate_certificate")
     * @Template("VirguleMainBundle:Student:attendance.html.twig")
     */
    public function generateCertificate(Student $student) {
        $org_branch = $this->getSelectedOrganizationBranch();
        $pdfGenerator = $this->get('siphoc.pdf.generator');
        
        $cleanFirstName = preg_replace("/[^A-Za-z0-9]/", "", $student->getFirstname());
        $cleanLastName = preg_replace("/[^A-Za-z0-9]/", "", $student->getLastname());
        $fileName = 'attestation-' . $cleanFirstName . '-' . $cleanLastName . '.pdf';
        $pdfGenerator->setName($fileName);
        return $pdfGenerator->downloadFromView(
            'VirguleMainBundle:Student:certificate.html.twig', 
            array('student' => $student, 'org_branch' => $org_branch, 'today' => new \DateTime('now')
            )
        );
    }
    
    /**
     * Display a list of the students to note their attendance
     *
     * @Route("/{id}/attendList", name="attendance_list")
     * @Template("VirguleMainBundle:Student:attendance.html.twig")
     */
    public function attendanceSlipAction(Course $id) {
        $students = $this->getStudentRepository()->loadAllEnrolledInCourse($id);
        return Array('course' => $id, 'students_array' => $students);
    }
    
    /**
     * Lists all Student entities enrolled in at least a class
     *
     * @Route("/", name="student_index")
     * @Template()
     */
    public function indexAction() {
        $students_lines = $this->getStudentManager()->loadAllEnrolled($this->getSelectedSemesterId());
        return array_merge(Array('title' => 'Tous les apprenants inscrits à un cours de cette session'), $students_lines);
    }   
    
    /**
     * Lists all Student entities.
     *
     * @Route("/all", name="student_index_all")
     * @Template("VirguleMainBundle:Student:index.html.twig")
     */
    public function indexAllAction() {
        $students_lines = $this->getStudentManager()->loadAll();
        return array_merge(Array('title' => 'Tous les apprenants'), $students_lines);
    }  
    /**
     * Lists all Student entities.
     *
     * @Route("/mystudents", name="index_my_students")
     * @Template("VirguleMainBundle:Student:myStudents.html.twig")
     */
    public function indexMyStudentsAction() {
        $em = $this->getDoctrine()->getManager();
        $teacherId = $this->getUser()->getId();
        $semesterId = $this->getSelectedSemesterId();
        $myCourses = $em->getRepository('VirguleMainBundle:Course')->getCoursesIdsByTeacher($semesterId, $teacherId);
        
        $courseIds = Array();
        foreach($myCourses as $course) {
            $courseIds[] = $course['id'];
        }
        $myStudents = Array();
        if (count($courseIds) > 0) {
            $myStudents = $em->getRepository('VirguleMainBundle:Student')->loadAllEnrolledInCourses($courseIds);
        }
        return array_merge(Array('title' => 'Mes apprenants'), Array('students_array' => $myStudents));
    }
    
    /**
     * Lists all Student entities.
     *     * 
     * @Route("/manyClasses", name="student_index_manyclasses"))
     * @Template("VirguleMainBundle:Student:index.html.twig")
     */
    public function indexManyClassesAction() {
        $students_lines = $this->getStudentManager()->loadAllEnrolledTwice($this->getSelectedSemesterId());
        return array_merge(Array('title' => 'Tous les apprenants inscrits à plus d\'un cours de cette session'), $students_lines);
    }
    
    /**
     * Lists all Student entities.
     *     * 
     * @Route("/noClass", name="student_index_noclass"))
     * @Template("VirguleMainBundle:Student:index.html.twig")
     */
    public function indexNoClassAction() {
        $students_lines = $this->getStudentManager()->loadAllNotEnrolled($this->getSelectedSemesterId());
        return array_merge(Array('title' => 'Tous les apprenants non inscrits à un cours de cette session'), $students_lines);
    }

    /**
     * Finds and displays a Student entity.
     *
     * @Route("/{id}/show", name="student_show")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->getStudentRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        // coment form
        $comment = new Comment();
        $commentForm = $this->createForm(new CommentType(), $comment);
        
        $courses = $this->getCourseRepository()->getCoursesByStudent($id);
        
        $nbClassSessionsAttended = $this->getStudentManager()->getAttendanceRate($courses, $id);
        
        $previousSemester = null;
        $nbEnrollment = count($courses);
        if ($nbEnrollment > 0) {
           $previousSemester = $courses[0]->getSemester()->getId();
        }
        
        $classLevels = $this->getClassLevelSuggestedRepository()->getClassLevelsHistoryPerStudent($id);
        $classLevelSuggested = new ClassLevelSuggested();
        $classLevelSuggestedForm = $this->createForm(new ClassLevelSuggestedType($this->getDoctrineManager()), $classLevelSuggested);
        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
            'commentForm' => $commentForm->createView(),
            'courses' => $courses,
            'nbEnrollment' => $nbEnrollment,
            'previousSemester' => $previousSemester,
            'classLevels' => $classLevels,
            'classLevelSuggestedForm' => $classLevelSuggestedForm->createView(),
            'nbClassSessionsAttended' => $nbClassSessionsAttended,
        );
    }

    
    private function initStudentForm($entity, $intention = 'create') {
        
        if ($intention == 'create') {
            $classLevelSuggested = new ClassLevelSuggested();
            $classLevelSuggested->setChanger($this->getUser());        
            $entity->addSuggestedClassLevel($classLevelSuggested);
        }
        
        $organizationBranchId = $this->getSelectedOrganizationBranchId();
        
        $semesterId = $this->getSelectedSemesterId();
        
        $openHousesDates = $this->getOpenHouseManager()->getOpenHousesDates($semesterId);
        
        $currentTeacher = $this->getConnectedUser();
        
        $form = $this->createForm(new StudentType($intention, $this->getDoctrineManager(), $this->getDoctrine(), $organizationBranchId, $openHousesDates, $currentTeacher, $semesterId), $entity, Array('em' => $this->getDoctrineManager()));

        return $form;
    }
    
    /**
     * Displays a form to create a new Student entity.
     *
     * @Route("/new", name="student_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Student();
        $form = $this->initStudentForm($entity);
        
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Student entity.
     *
     * @Route("/create", name="student_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Student:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Student();
        $form = $this->initStudentForm($entity);
        
        $form->bind($request);

        if ($form->isValid()) {
            $entity->setNativeCountry($entity->getNativeCountry());
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            $this->saveSuggestedClassLevel($entity, $em);
            
            $em->persist($entity);
            $em->flush();

            $this->addFlash( 'La fiche de <strong>' . $entity->getFirstname() . ' ' . $entity->getLastname()  . '</strong> a bien été créée.');
            
            if ($request->get('save_and_add_new')) {
                return $this->redirect($this->generateUrl('student_new'));
            } else {
                return $this->redirect($this->generateUrl('student_show', array('id' => $entity->getId())));
            }
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Student entity.
     *
     * @Route("/{id}/edit", name="student_edit")
     * @Template()
     */
    public function editAction($id) {

        $entity = $this->getStudentRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        $editForm = $this->initStudentForm($entity, 'edit');
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Student entity.
     *
     * @Route("/{id}/update", name="student_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:Student:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrineManager();

        $entity = $this->getStudentRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->initStudentForm($entity, 'edit');
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $entity->setNativeCountry($entity->getNativeCountry());
            
            $entity->setUpdatedAt();
            $entity->setUpdatedByTeacher($this->getUser());
            $em->persist($entity);
            
            $em->flush();            
            
            $this->addFlash( 'La fiche de <strong>' . $entity->getFirstname() . ' ' . $entity->getLastname()  . '</strong> a été mise à jour.');

            return $this->redirect($this->generateUrl('student_show', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    private function saveSuggestedClassLevel($entity, $em) {
        // manual persist as we're dealing with the inversed side
        $suggestedClassLevels = $entity->getSuggestedClassLevel();
        foreach($suggestedClassLevels as $suggestedClassLevel) {
            $suggestedClassLevel->setStudent($entity);
            $em->persist($suggestedClassLevel);
        }
    }
    /**
     * Deletes a Student entity.
     *
     * @Route("/{id}/delete", name="student_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrineManager();
            $entity = $this->getStudentRepository()->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Student entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('student_index'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
}
