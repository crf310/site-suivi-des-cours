<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Course;
use Virgule\Bundle\MainBundle\Form\CourseType;

/**
 * Course controller.
 *
 * @Route("/course")
 */
class CourseController extends AbstractVirguleController {

    /**
     * Lists all Course entities.
     *
     * @Route("/")
     * @Route("/page/{page}", requirements={"page" = "\d+"}, defaults={"page" = "1"}, name="course_index")
     * @Template()
     */
    public function indexAction($page = 1) {
         
        $em = $this->getDoctrine()->getManager();

        $semesterId = $this->getSelectedSemesterId();
        $courses = $em->getRepository('VirguleMainBundle:Course')->loadAll($semesterId);
        
        // sub array to group multiple teachers      
        $course_ids = Array();
        $teachers_array = Array();
        foreach ($courses as $key => $course) {
            
            $teachers_array[$course['course_id']][] = Array('teacher_id' => $course['teacher_id'],
            'teacher_firstName' => $course['teacher_firstName'],
            'teacher_lastName' => $course['teacher_lastName']);
            
            // delete doubled
            if (array_key_exists($course['course_id'], $course_ids)) {
                 unset($courses[$key]);
            }
            $course_ids[$course['course_id']] = 1;
        }
        $entities_paginated = $this->paginate($courses, $page);
        $other_entities = Array('teachers_array' => $teachers_array);
        return array_merge($entities_paginated, $other_entities);
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

            $this->get('session')->setFlash(
                'notice',
                'Nouveau cours créé avec succès !'
            );
            
            if ($request->get('save_and_add_new')) {
                return $this->redirect($this->generateUrl('course_new'));
            } else {
                return $this->redirect($this->generateUrl('course_index'));
            }
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
