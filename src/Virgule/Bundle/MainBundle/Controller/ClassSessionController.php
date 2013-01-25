<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Controller\AbstractVirguleController;
use Virgule\Bundle\MainBundle\Entity\ClassSession;
use Virgule\Bundle\MainBundle\Form\ClassSessionType;

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
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:ClassSession')->findAll();

        return parent::paginate($entities, $page);
    }

    /**
     * Finds and displays a ClassSession entity.
     *
     * @Route("/{id}/show", name="classsession_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:ClassSession')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassSession entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new ClassSession entity.
     *
     * @Route("/new", name="classsession_new")
     * @Route("/add/course/${course_id}", name="classsession_add")
     * @Template()
     */
    public function newAction($course_id=null) {
        $entity = new ClassSession();
        $form = $this->createForm(new ClassSessionType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
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
        $form = $this->createForm(new ClassSessionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('classsession_show', array('id' => $entity->getId())));
        }

        return array(
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
