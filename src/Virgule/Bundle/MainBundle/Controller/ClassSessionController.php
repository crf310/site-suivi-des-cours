<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Controller\AbstractVirguleController;
use Virgule\Bundle\MainBundle\Entity\ClassSession;
use Virgule\Bundle\MainBundle\Entity\Comment;
use Virgule\Bundle\MainBundle\Form\ClassSessionType;
use Virgule\Bundle\MainBundle\Form\CommentType;

/**
 * ClassSession controller.
 *
 * @Route("/classsession")
 */
class ClassSessionController extends AbstractVirguleController {

    /**
     * Lists all ClassSession entities.
     *
     * @Route("/page/{page}", requirements={"page" = "\d+"}, defaults={"page" = "1"}, name="classsession_index")
     * @Template()
     */
    public function indexAction($page = 1) {
        $em = $this->getEntityManager();        
        $classSessions = $em->getRepository('VirguleMainBundle:ClassSession')->loadAll($this->getSelectedSemesterId());

        return array('entities' => $classSessions);
    }

    /**
     * Finds and displays a ClassSession entity.
     *
     * @Route("/{id}/show", name="classsession_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getEntityManager();  

        $entity = $em->getRepository('VirguleMainBundle:ClassSession')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassSession entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $comment = new Comment();
        $commentForm = $this->createForm(new CommentType(), $comment);
        
        $students = $em->getRepository('VirguleMainBundle:Student')->loadAllPresentAtClassSession($id);
        
        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
            'commentForm' => $commentForm->createView(),
            'students' => $students,
        );
    }
    
    private function initClassSessionForm($entity, $courseId) {
        $organizationBranchId = $this->getSelectedOrganizationBranchId();
        $currentTeacher = $this->getConnectedUser();
        
        $form = $this->createForm(new ClassSessionType($this->getDoctrine(), $courseId, $organizationBranchId, $currentTeacher), $entity);
        
        return $form;
    }

    /**
     * Displays a form to create a new ClassSession entity.
     *
     * @Route("/new", name="classsession_new")
     * @Route("/add/course/{course_id}", name="classsession_add")
     * @Template()
     */
    public function newAction($course_id) {
        $entity = new ClassSession();      
        $form = $this->initClassSessionForm($entity, $course_id);
        
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository('VirguleMainBundle:Course')->find($course_id);
        
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'course'=> $course
        );
    }


    /**
     * Creates a new ClassSession entity.
     *
     * @Route("/create", name="classsession_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:ClassSession:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new ClassSession();      
        $courseId = $request->get('course_id');
        $form = $this->initClassSessionForm($entity, $courseId);
                
        $form->bind($request);

        $courseId = $form->get('course_id')->getData();
        $em = $this->getEntityManager();        
        $course = $em->getRepository('VirguleMainBundle:Course')->find($courseId);
        $entity->setCourse($course);
        $entity->setReportDate(new \Datetime('now'));
        
        $connectedUser = $this->getConnectedUser();
        $entity->setReportTeacher($connectedUser);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('classsession_index'));
        }
        
        return array(
            'course_id' => $courseId,
            'course' => $course,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ClassSession entity.
     *
     * @Route("/{id}/edit", name="classsession_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassSession')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassSession entity.');
        }

        $editForm = $this->createForm(new ClassSessionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ClassSession entity.
     *
     * @Route("/{id}/update", name="classsession_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:ClassSession:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassSession')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassSession entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ClassSessionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('classsession_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ClassSession entity.
     *
     * @Route("/{id}/delete", name="classsession_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:ClassSession')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ClassSession entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('classsession'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
