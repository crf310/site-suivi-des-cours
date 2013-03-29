<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\OpenHouse;
use Virgule\Bundle\MainBundle\Form\OpenHouseType;

/**
 * OpenHouse controller.
 *
 * @Route("/openhouse")
 */
class OpenHouseController extends AbstractVirguleController
{
    /**
     * Lists all OpenHouse entities.
     *
     * @Route("/", name="openhouse")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:OpenHouse')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new OpenHouse entity.
     *
     * @Route("/", name="openhouse_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:OpenHouse:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new OpenHouse();
        $form = $this->createForm(new OpenHouseType(), $entity);
        $form->bind($request);
        
        $entity->setSemester($this->getSelectedSemester());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $this->addFlash('Journée d\accueil créée avec succès !');
             
            return $this->redirect($this->generateUrl('semester_index'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new OpenHouse entity.
     *
     * @Route("/new", name="openhouse_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new OpenHouse();
        $form   = $this->createForm(new OpenHouseType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a OpenHouse entity.
     *
     * @Route("/{id}", name="openhouse_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:OpenHouse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpenHouse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing OpenHouse entity.
     *
     * @Route("/{id}/edit", name="openhouse_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:OpenHouse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpenHouse entity.');
        }

        $editForm = $this->createForm(new OpenHouseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing OpenHouse entity.
     *
     * @Route("/{id}", name="openhouse_update")
     * @Method("PUT")
     * @Template("VirguleMainBundle:OpenHouse:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:OpenHouse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpenHouse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OpenHouseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('openhouse_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a OpenHouse entity.
     *
     * @Route("/{id}", name="openhouse_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:OpenHouse')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OpenHouse entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('openhouse'));
    }

    /**
     * Creates a form to delete a OpenHouse entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
