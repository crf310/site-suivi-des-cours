<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Roles;
use Virgule\Bundle\MainBundle\Form\Type\RolesType;

/**
 * Roles controller.
 *
 * @Route("/roles")
 */
class RolesController extends Controller
{
    /**
     * Lists all Roles entities.
     *
     * @Route("/", name="roles")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:Roles')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Roles entity.
     *
     * @Route("/{id}/show", name="roles_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Roles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Roles entity.
     *
     * @Route("/new", name="roles_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Roles();
        $form   = $this->createForm(new RolesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Roles entity.
     *
     * @Route("/create", name="roles_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Roles:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Roles();
        $form = $this->createForm(new RolesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roles_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Roles entity.
     *
     * @Route("/{id}/edit", name="roles_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Roles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roles entity.');
        }

        $editForm = $this->createForm(new RolesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Roles entity.
     *
     * @Route("/{id}/update", name="roles_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:Roles:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Roles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RolesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roles_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Roles entity.
     *
     * @Route("/{id}/delete", name="roles_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:Roles')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Roles entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('roles'));
    }
    
}
