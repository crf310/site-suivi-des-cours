<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Controller\AbstractVirguleController;
use Virgule\Bundle\MainBundle\Entity\ClassSession;
use Virgule\Bundle\MainBundle\Entity\Comment;
use Virgule\Bundle\MainBundle\Entity\Course;
use Virgule\Bundle\MainBundle\Entity\ClassLevel;
use Virgule\Bundle\MainBundle\Form\ClassSessionType;
use Virgule\Bundle\MainBundle\Form\CommentType;

use Ivory\LuceneSearchBundle\Model\Document;
use Ivory\LuceneSearchBundle\Model\Field;
/**
 * ClassSession controller.
 *
 * @Route("/classsession")
 */
class ClassSessionController extends AbstractVirguleController {
    /**
     * Lists all ClassSession entities.
     *
     * @Route("/", name="classsession_index")
     * @Route("/level/{id}", name="classsession_index_per_level")
     * @Template()
     */
    public function indexAction($id = null) {
        $classLevels = $this->getClassLevelRepository()->findAll();
        $courses = $this->getCourseRepository()->loadAll($this->getSelectedSemesterId());
        
        if ($id == null) {
            $classSessions = $this->getClassSessionRepository()->loadAll($this->getSelectedSemesterId());
        } else {
            $classSessions = $this->getClassSessionRepository()->loadAllClassSessionByClassLevel($id, $this->getSelectedSemesterId());
        }
        
        return array('classSessions' => $classSessions, 'classLevels' => $classLevels, 'currentClassLevelId' => $id, 'courses' => $courses);
    }
    
    /**
     * Lists all ClassSession entities per level.
     *
     * @Template("VirguleMainBundle:ClassSession:indexPerLevel.html.twig")
     */
    public function indexPerLevelAction() {

    }    

    /**
     * Lists ClassSession entities into a RSS feed
     *
     * @Route("/rss/feed", name="classsession_rss_feed_all")     * 
     * @Route("/rss/feed/level/{id}", name="classsession_rss_feed_classlevel")
     * @Template("VirguleMainBundle:ClassSession:list.rss.twig")
     */
    public function rssAction($id = null) {
        $em = $this->getDoctrineManager(); 
        
        if (null === $id) {
            $classSessions = $em->getRepository('VirguleMainBundle:ClassSession')->loadAll($this->getSelectedSemesterId());
        } else {
            $classSessions = $em->getRepository('VirguleMainBundle:ClassSession')->loadAllClassSessionByClassLevel($id, $this->getSelectedSemesterId());
        }

        return array('classSessions' => $classSessions);
    }
    
    /**
     * Lists all ClassSession RSS feeds available
     *
     * @Route("/rss", name="classsession_rss_index")
     * @Template("VirguleMainBundle:ClassSession:index_rss.html.twig")
     */
    public function rssIndexAction() {
        $classLevelRepository = $this->getClassLevelRepository(); 
        $classLevels = $classLevelRepository->findAll();

        return array('classLevels' => $classLevels);
    }
    
    /**
     * Finds and displays a ClassSession entity.
     *
     * @Route("/{id}/show", name="classsession_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrineManager();  

        $entity = $em->getRepository('VirguleMainBundle:ClassSession')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClassSession entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $comment = new Comment();
        $commentForm = $this->createForm(new CommentType(), $comment);
        
        $classSessionEnrolledStudents = $em->getRepository('VirguleMainBundle:Student')->loadAllEnrolledPresentAtClassSession($id);
        $classSessionNonEnrolledStudents = $em->getRepository('VirguleMainBundle:Student')->loadAllNonEnrolledPresentAtClassSession($id);
        
        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
            'commentForm' => $commentForm->createView(),
            'classSessionEnrolledStudents' => $classSessionEnrolledStudents,
            'classSessionNonEnrolledStudents' => $classSessionNonEnrolledStudents,
        );
    }
    
    /**
     * Displays a form to create a new ClassSession entity.
     *
     * @Route("/add", name="classsession_new")
     * @Route("/add/course/{id}", name="classsession_add")
     * @Template()
     */
    public function newAction(Course $course = null) {
        $classSession = new ClassSession();
        $classSession->setCourse($course);
       
        $organizationBranchId = $this->getSelectedOrganizationBranchId();
        $currentTeacher = $this->getConnectedUser();
        $semesterId = $this->getSelectedSemesterId();
        
        $form = $this->createForm(new ClassSessionType($this->getDoctrineManager(), $organizationBranchId, $currentTeacher, $semesterId), $classSession, array('em' => $this->getDoctrine()->getManager()));
       
        return array(
            'entity' => $classSession,
            'form' => $form->createView()
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
        $organizationBranchId = $this->getSelectedOrganizationBranchId();
        $currentTeacher = $this->getConnectedUser();
        $semesterId = $this->getSelectedSemesterId();
                
        $form = $this->createForm(new ClassSessionType($this->getDoctrineManager(), $organizationBranchId, $currentTeacher, $semesterId), $entity, array('em' => $this->getDoctrine()->getManager()));
        $form->bind($request);   
        
        $entity->setReportDate(new \Datetime('now'));
        
        $course = $form->get('course')->getData();
        
        if (! $course instanceof Course) {
            $course = $this->getCourseRepository()->find($course);
        }

        $entity->setCourse($course);
            
        $connectedUser = $this->getConnectedUser();
        $entity->setReportTeacher($connectedUser);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);           
            $em->flush();

            $this->addFlash('Votre compte-rendu pour le ' . $entity->getSessionDate()->format('d/m/Y') . ' a bien été enregistré : <a href="' . $this->generateUrl('classsession_show', Array('id' => $entity->getId())) . '">n°' . $entity->getId() . '</a>');
            
            return $this->redirect($this->generateUrl('classsession_index'));
        }
        
        $this->logDebug("Students saved: " . count($entity->getClassSessionStudents()));
        foreach ($entity->getClassSessionStudents() as $student) {
            $this->logDebug($student->getId());
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
        
        $organizationBranchId = $this->getSelectedOrganizationBranchId();
        $currentTeacher = $this->getConnectedUser();
        $semesterId = $this->getSelectedSemesterId();
        
        $editForm = $this->createForm(new ClassSessionType($this->getDoctrineManager(), $organizationBranchId, $currentTeacher, $semesterId), $entity, array('em' => $this->getDoctrine()->getManager()));
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

        
        $organizationBranchId = $this->getSelectedOrganizationBranchId();
        $currentTeacher = $this->getConnectedUser();
        $semesterId = $this->getSelectedSemesterId();
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ClassSessionType($this->getDoctrineManager(), $organizationBranchId, $currentTeacher, $semesterId), $entity, array('em' => $this->getDoctrine()->getManager()));
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->addFlash('Le compte-rendu n<sup>o</sup>' . $entity->getId() . ' a bien été mis à jour.');
            return $this->redirect($this->generateUrl('classsession_show', array('id' => $id)));
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

        return $this->redirect($this->generateUrl('classsession_index'));
    }

}
