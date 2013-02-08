<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Attachment;
use Virgule\Bundle\MainBundle\Form\AttachmentType;

/**
 * Attachment controller.
 *
 * @Route("/attachment")
 */
class AttachmentController extends Controller
{
    /**
     * Lists all Attachment entities.
     *
     * @Route("/", name="attachment")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:Attachment')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Attachment entity.
     *
     * @Route("/{id}/show", name="attachment_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Attachment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attachment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Attachment entity.
     *
     * @Route("/new", name="attachment_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Attachment();
        $form   = $this->createForm(new AttachmentType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Attachment entity.
     *
     * @Route("/create", name="attachment_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Attachment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Attachment();
        $form = $this->createForm(new AttachmentType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attachment_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Attachment entity.
     *
     * @Route("/{id}/edit", name="attachment_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Attachment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attachment entity.');
        }

        $editForm = $this->createForm(new AttachmentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Attachment entity.
     *
     * @Route("/{id}/update", name="attachment_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:Attachment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Attachment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attachment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AttachmentType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attachment_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Attachment entity.
     *
     * @Route("/{id}/delete", name="attachment_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:Attachment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Attachment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attachment'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
