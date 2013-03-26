<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Semester;
use Virgule\Bundle\MainBundle\Form\SemesterType;

/**
 * Semester controller.
 *
 * @Route("/semester")
 */
class SemesterController extends AbstractVirguleController {
    
    private function getManager() {
        return $this->get('virgule.semester_manager');
    }
    /**
     * Lists all Semester entities.
     *
     * @Route("/", name="semester_index")
     * @Template()
     */
    public function indexAction() {
        $semesters = $this->getManager()->loadAllSemestersForBranch($this->getSelectedOrganizationBranchId());

        return array(
            'semesters' => $semesters,
        );
    }

    /**
     * Finds and displays a Semester entity.
     *
     * @Route("/{id}/show", name="semester_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Semester')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Semester entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Semester entity.
     *
     * @Route("/new", name="semester_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Semester();
        $form = $this->createForm(new SemesterType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Semester entity.
     *
     * @Route("/create", name="semester_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Semester:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Semester();
        $form = $this->createForm(new SemesterType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('semester_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Semester entity.
     *
     * @Route("/{id}/edit", name="semester_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Semester')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Semester entity.');
        }

        $editForm = $this->createForm(new SemesterType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Semester entity.
     *
     * @Route("/{id}/update", name="semester_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:Semester:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Semester')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Semester entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SemesterType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('semester_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Semester entity.
     *
     * @Route("/{id}/delete", name="semester_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:Semester')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Semester entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('semester'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
