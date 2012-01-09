<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Formateurs;
use Virgule\Bundle\MainBundle\Form\FormateursType;

/**
 * Formateurs controller.
 *
 * @Route("/formateurs")
 */
class FormateursController extends Controller
{
    /**
     * Lists all Formateurs entities.
     *
     * @Route("/", name="formateurs")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('VirguleMainBundle:Formateurs')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Formateurs entity.
     *
     * @Route("/{id}/show", name="formateurs_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('VirguleMainBundle:Formateurs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formateurs entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Formateurs entity.
     *
     * @Route("/new", name="formateurs_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Formateurs();
        $form   = $this->createForm(new FormateursType(), $entity);
        /*return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );*/

        return $this->render('VirguleMainBundle:Formateurs:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Formateurs entity.
     *
     * @Route("/create", name="formateurs_create")
     * @Method("post")
     * @Template("VirguleMainBundle:Formateurs:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Formateurs();
        $request = $this->getRequest();
        $form    = $this->createForm(new FormateursType(), $entity);
        $form->bindRequest($request);

        $logger = $this->get('logger');
        if ($form->isValid()) {
            $logger->info('New teacher created: valid');

            $entity->setDateInscription(new \DateTime("now"));

            $mdpHash = md5($entity->getMotDePasse());
            $entity->setMotDePasse($mdpHash);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formateurs_show', array('id' => $entity->getIdFormateur())));
        } else {

            $logger->info('New Formateur invalid');

        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Formateurs entity.
     *
     * @Route("/{id}/edit", name="formateurs_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('VirguleMainBundle:Formateurs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formateurs entity.');
        }

        $editForm = $this->createForm(new FormateursType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Formateurs entity.
     *
     * @Route("/{id}/update", name="formateurs_update")
     * @Method("post")
     * @Template("VirguleMainBundle:Formateurs:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('VirguleMainBundle:Formateurs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formateurs entity.');
        }

        $editForm   = $this->createForm(new FormateursType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formateurs_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Formateurs entity.
     *
     * @Route("/{id}/delete", name="formateurs_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('VirguleMainBundle:Formateurs')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Formateurs entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formateurs'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
