<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Document;
use Virgule\Bundle\MainBundle\Entity\Tag;
use Virgule\Bundle\MainBundle\Form\DocumentType;

/**
 * Document controller.
 *
 * @Route("/document")
 */
class DocumentController extends AbstractVirguleController {

    /**
     * Returns document file
     *
     * @Route("/download/{id}", name="document_download")
     * @Method("GET")
     */
    public function downloadAction(Document $id) {
        $file = $id->getAbsolutePath();
        $response = new BinaryFileResponse($file);
        return $response;
    }
    
    /**
     * Lists all Document entities.
     *
     * @Route("/", name="document_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $documents = $this->getDocumentManager()->getAllDocuments();

        return array(
            'documents' => $documents,
        );
    }

    /**
     * Creates a new Document entity.
     *
     * @Route("/", name="document_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Document:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Document();
        $form = $this->createForm(new DocumentType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $entity->setUploadDate(new \Datetime('now'));
            $entity->setUploader($this->getUser());
            
            // tags
            $sTags = $form->get('tagList')->getData();
            $aTags = explode(',', $sTags);
            $tags = $this->getTagManager()->createOrAddTags($aTags);
            foreach ($tags as $tag) {
                $entity->addTag($tag);
            }
                        
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            // return $this->redirect($this->generateUrl('document_show', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('document_index'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Document entity.
     *
     * @Route("/new", name="document_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Document();
        $tag1 = new Tag();
        $entity->addTag($tag1);
        
        $existingTags = $this->getTagRepository()->findAll();
        
        $form = $this->createForm(new DocumentType(), $entity);
        
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'existingTags' => $existingTags,
        );
    }

    /**
     * Finds and displays a Document entity.
     *
     * @Route("/{id}", name="document_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Document')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Document entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Document entity.
     *
     * @Route("/{id}/edit", name="document_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Document')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Document entity.');
        }

        $editForm = $this->createForm(new DocumentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Document entity.
     *
     * @Route("/{id}", name="document_update")
     * @Method("PUT")
     * @Template("VirguleMainBundle:Document:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Document')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Document entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DocumentType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('document_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Document entity.
     *
     * @Route("/{id}", name="document_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:Document')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Document entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('document'));
    }

    /**
     * Creates a form to delete a Document entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
