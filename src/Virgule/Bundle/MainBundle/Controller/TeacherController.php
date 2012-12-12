<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Teacher;
use Virgule\Bundle\MainBundle\Form\TeacherType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

/**
 * Teacher controller.
 *
 * @Route("/teacher")
 */
class TeacherController extends Controller {

    private function getManager() {
        return $this->get('virgule.teacher_manager');
    }

    /**
     * Lists all Teacher entities.
     *
     * @Route("/", name="teacher_index")
     * @Route("/page/{page}", requirements={"page" = "\d+"}, defaults={"page" = "1"})
     * @Template()
     */
    public function indexAction($page=1) {
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:Teacher')->findAll();

        $pagerfanta = new Pagerfanta(new ArrayAdapter($entities));
        $pagerfanta->setMaxPerPage(10);

        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        return array(
		'entities' => $pagerfanta
		);
    }

    /**
     * Finds and displays a Teacher entity.
     *
     * @Route("/{id}/show", name="teacher_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Teacher')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Teacher entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Teacher entity.
     *
     * @Route("/new", name="teacher_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Teacher();
        $form = $this->createForm(new TeacherType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Teacher entity.
     *
     * @Route("/create", name="teacher_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Teacher:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Teacher();
        $form = $this->createForm(new TeacherType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('teacher_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Teacher entity.
     *
     * @Route("/{id}/edit", name="teacher_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Teacher')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Teacher entity.');
        }

        $editForm = $this->createForm(new TeacherType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Teacher entity.
     *
     * @Route("/{id}/update", name="teacher_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:Teacher:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Teacher')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Teacher entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TeacherType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('teacher_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Teacher entity.
     *
     * @Route("/{id}/delete", name="teacher_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:Teacher')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Teacher entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('teacher'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
