<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\ClassLevel;
use Virgule\Bundle\MainBundle\Form\ClassLevelType;

/**
 * ClassLevel controller.
 *
 * @Route("/classlevel")
 */
class ClassLevelController extends Controller
{
    /**
     * Lists all ClassLevel entities.
     *
     * @Route("/", name="classlevel")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:ClassLevel')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a ClassLevel entity.
     *
     * @Route("/{id}/show", name="classlevel_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassLevel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new ClassLevel entity.
     *
     * @Route("/new", name="classlevel_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ClassLevel();
        $form   = $this->createForm(new ClassLevelType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new ClassLevel entity.
     *
     * @Route("/create", name="classlevel_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:ClassLevel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new ClassLevel();
        $form = $this->createForm(new ClassLevelType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('classlevel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ClassLevel entity.
     *
     * @Route("/{id}/edit", name="classlevel_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassLevel entity.');
        }

        $editForm = $this->createForm(new ClassLevelType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ClassLevel entity.
     *
     * @Route("/{id}/update", name="classlevel_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:ClassLevel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassLevel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ClassLevelType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('classlevel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ClassLevel entity.
     *
     * @Route("/{id}/delete", name="classlevel_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:ClassLevel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ClassLevel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('classlevel'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
