<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\OrganizationBranch;
use Virgule\Bundle\MainBundle\Form\Type\OrganizationBranchType;

/**
 * OrganizationBranch controller.
 *
 * @Route("/organizationbranch")
 */
class OrganizationBranchController extends AbstractVirguleController {

    /**
     * Lists all OrganizationBranch entities.
     *
     * @Route("/", name="organizationbranch_index")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:OrganizationBranch')->findAll();

        $entity = new OrganizationBranch();
        $form = $this->createForm(new OrganizationBranchType(), $entity);
        
        return array(
            'entities' => $entities,            
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a OrganizationBranch entity.
     *
     * @Route("/{id}/show", name="organizationbranch_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $organizationBranch = $em->getRepository('VirguleMainBundle:OrganizationBranch')->find($id);

        $classRooms = $this->getClassRoomRepository()->getClassRoomsForOrganizationBranch($organizationBranch->getId());
        
        if (!$organizationBranch) {
            throw $this->createNotFoundException('Unable to find OrganizationBranch entity.');
        }

        return array(
            'organizationBranch' => $organizationBranch,
            'classRooms' => $classRooms
        );
    }

    /**
     * Displays a form to create a new OrganizationBranch entity.
     *
     * @Route("/new", name="organizationbranch_new")
     * @Template()
     */
    public function newAction() {
        $entity = new OrganizationBranch();
        $form = $this->createForm(new OrganizationBranchType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new OrganizationBranch entity.
     *
     * @Route("/create", name="organizationbranch_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:OrganizationBranch:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new OrganizationBranch();
        $form = $this->createForm(new OrganizationBranchType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organizationbranch_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing OrganizationBranch entity.
     *
     * @Route("/{id}/edit", name="organizationbranch_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:OrganizationBranch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrganizationBranch entity.');
        }

        $editForm = $this->createForm(new OrganizationBranchType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing OrganizationBranch entity.
     *
     * @Route("/{id}/update", name="organizationbranch_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:OrganizationBranch:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:OrganizationBranch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrganizationBranch entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OrganizationBranchType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organizationbranch_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a OrganizationBranch entity.
     *
     * @Route("/{id}/delete", name="organizationbranch_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:OrganizationBranch')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OrganizationBranch entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('organizationbranch'));
    }

}
