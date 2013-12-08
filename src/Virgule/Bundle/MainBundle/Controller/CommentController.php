<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Controller\AbstractVirguleController;
use Virgule\Bundle\MainBundle\Entity\Comment;
use Virgule\Bundle\MainBundle\Form\CommentType;

/**
 * Comment controller.
 *
 * @Route("/comment")
 */
class CommentController extends AbstractVirguleController {

    /**
     * Lists all Comment entities.
     *
     * @Route("/", name="comment")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:Comment')->findAll();

        return super . paginate($entities);
    }

    /**
     * Finds and displays a Comment entity.
     *
     * @Route("/{id}/show", name="comment_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Comment entity.
     *
     * @Route("/new", name="comment_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Comment();
        $form = $this->createForm(new CommentType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    private function createComment(Request $request, Comment $comment) {
        $comment->setDate(new \DateTime('now'));
        $form = $this->createForm(new CommentType(), $comment);
        $form->bind($request);

        $teacher = $this->getUser();
        if (!$teacher) {
            throw $this->createNotFoundException('Unable to find Teacher entity.');
        }
        $comment->setTeacher($teacher);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $this->addFlash('Votre commentaire a bien été enregistré');
            
            return true;
        }
        return false;
    }

    /**
     * Creates a new Comment entity
     * related to a Student
     *
     * @Route("/create/student/{id}", name="student_comment_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Comment:new.html.twig")
     */
    public function createStudentCommentAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('VirguleMainBundle:Student')->find($id);

        if (!$student) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        $comment = new Comment();
        $comment->setStudent($student);

        if ($this->createComment($request, $comment)) {
            return $this->redirect($this->generateUrl('student_show', array('id' => $id)));
        }
    }

    /**
     * Creates a new Comment entity
     * related to a Student
     *
     * @Route("/create/classsession/{id}", name="classsession_comment_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Comment:new.html.twig")
     */
    public function createClassSessionCommentAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $classSession = $em->getRepository('VirguleMainBundle:ClassSession')->find($id);

        if (!$classSession) {
            throw $this->createNotFoundException('Unable to find ClassSession entity.');
        }

        $comment = new Comment();
        $comment->setClassSession($classSession);

        if ($this->createComment($request, $comment)) {
            return $this->redirect($this->generateUrl('classsession_show', array('id' => $id)));
        }
    }

    /**
     * Displays a form to edit an existing Comment entity.
     *
     * @Route("/{id}/edit", name="comment_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $editForm = $this->createForm(new CommentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Comment entity.
     *
     * @Route("/{id}/update", name="comment_update")
     * @Method("POST")
     * @Template("VirguleMainBundle:Comment:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CommentType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comment_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Comment entity.
     *
     * @Route("/{id}/delete", name="comment_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:Comment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comment'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
