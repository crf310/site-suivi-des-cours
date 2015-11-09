<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\ClassRoom;
use Virgule\Bundle\MainBundle\Form\ClassRoomType;

/**
 * ClassRoom controller.
 *
 * @Route("/classroom")
 */
class ClassRoomController extends Controller {

    /**
     * Lists all ClassRoom entities.
     *
     * @Route("/", name="classroom")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:ClassRoom')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a ClassRoom entity.
     *
     * @Route("/{id}/show", name="classroom_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassRoom')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassRoom entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new ClassRoom entity.
     *
     * @Route("/new", name="classroom_new")
     * @Template()
     */
    public function newAction() {
        $entity = new ClassRoom();
        $form = $this->createForm(new ClassRoomType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new ClassRoom entity.
     *
     * @Route("/create", name="classroom_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:ClassRoom:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new ClassRoom();
        $form = $this->createForm(new ClassRoomType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('classroom_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ClassRoom entity.
     *
     * @Route("/{id}/edit", name="classroom_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassRoom')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassRoom entity.');
        }

        $editForm = $this->createForm(new ClassRoomType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ClassRoom entity.
     *
     * @Route("/{id}/update", name="classroom_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:ClassRoom:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassRoom')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassRoom entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ClassRoomType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('classroom_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ClassRoom entity.
     *
     * @Route("/{id}/delete", name="classroom_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:ClassRoom')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ClassRoom entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('classroom'));
    }

}
