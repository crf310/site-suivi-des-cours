<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Course;
use Virgule\Bundle\MainBundle\Entity\Planning\Planning;
use Virgule\Bundle\MainBundle\Form\CourseType;

/**
 * Course controller.
 *
 * @Route("/course")
 */
class CourseController extends AbstractVirguleController {

    private function getRepository() {
        $em = $this->getEntityManager();
        return $em->getRepository('VirguleMainBundle:Course');
    }
    
    private function getManager() {
        return $this->get('virgule.course_manager');
    }
    
    /**
     *
     * @Route("/printPlanning", name="course_print_planning"))
     * @Template("VirguleMainBundle:Course:planning.print.html.twig")
     */
    public function printPlanningAction() {
        return $this->generatePlanning();
    }
    
    /**
     * Lists all Course entities.
     *
     * @Route("/showPlanning", name="course_show_planning"))
     * @Template("VirguleMainBundle:Course:planning.web.html.twig")
     */
    public function showPlanningAction() {
        return $this->generatePlanning();
    }
    
    private function generatePlanning() {
        $semesterId = $this->getSelectedSemesterId();
        
        $courses = $this->getManager()->getAllHydratedCourses($semesterId);
        
        // $organizationBranchId = $this->getSelectedOrganizationBranchId();
        // $classRooms = $this->getEntityManager()->getRepository('VirguleMainBundle:ClassRoom')->getClassRoomsForOrganizationBranch($organizationBranchId);
        
        $planning = new Planning($courses);
        return Array('headerCells' => $planning->getHeader(), 'planningRows' => $planning->getRows());
        
    }
    /**
     * Lists all Course entities.
     *
     * @Route("/", name="course_index")
     * @Template()
     */
    public function indexAction() {
        $semesterId = $this->getSelectedSemesterId();
        
        $courses = $this->getManager()->getAllHydratedCourses($semesterId);
        
        return Array('courses' => $courses);
    }

    /**
     * Finds and displays a Course entity.
     *
     * @Route("/{id}/show", name="course_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Course')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Course entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
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
        $teacherRepository = $em->getRepository('VirguleMainBundle:Teacher');
                
        $entity = new Course();
        $organizationBranchId = $this->getSelectedOrganizationBranch()->getId();
        $form = $this->createForm(new CourseType($teacherRepository, $organizationBranchId), $entity);

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
        $teacherRepository = $em->getRepository('VirguleMainBundle:Teacher');
               
        $form = $this->createForm(new CourseType($teacherRepository, $organizationBranch->getId()), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->addFlash('Nouveau cours créé avec succès !');
            
            if ($request->get('save_and_add_new')) {
                return $this->redirect($this->generateUrl('course_new'));
            } else {
                return $this->redirect($this->generateUrl('course_index'));
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Course')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Course entity.');
        }

        $editForm = $this->createForm(new CourseType(), $entity);
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Course')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Course entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CourseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('course_edit', array('id' => $id)));
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
            $entity = $em->getRepository('VirguleMainBundle:Course')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Course entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('course'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
