<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Controller\AbstractVirguleController;
use Virgule\Bundle\MainBundle\Entity\Comment;
use Virgule\Bundle\MainBundle\Form\Type\CommentType;

/**
 * Comment controller.
 *
 * @Route("/comment")
 */
class CommentController extends AbstractVirguleController {

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

}
