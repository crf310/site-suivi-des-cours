<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Teacher;
use Virgule\Bundle\MainBundle\Form\TeacherType;
use Virgule\Bundle\MainBundle\Form\TeacherChangePasswordType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Teacher controller.
 *
 * @Route("/teacher")
 */
class TeacherController extends AbstractVirguleController {

    private function getManager() {
        return $this->get('virgule.teacher_manager');
    }

    /**
     * Lists all Teacher entities.
     *
     * @Route("/")
     * @Route("/status/{status}", requirements={"status" = "^[a-zA-Z]+$"}, defaults={"status" = "active"}, name="teacher_index")
     * @Template()
     */
    public function indexAction($status="active") {
        $isActive = false;
        if ($status == 'active' && $status != 'inactive') {
            $isActive = true;
        }
        
        $em = $this->getDoctrine()->getManager();

        $organizationBranchId = $this->getRequest()->getSession()->get('organizationBranchId');
        $entities = $em->getRepository('VirguleMainBundle:Teacher')->getTeachersByStatus($organizationBranchId, $isActive);

        return Array('entities' => $entities, 'status' => $status);
    }

    /**
     * Finds and displays a Teacher entity.
     *
     * @Route("/{id}/show", name="teacher_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Teacher')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Teacher entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        // courses
        $semesterId = $this->getSelectedSemesterId();
        $teacherCourses = $em->getRepository('VirguleMainBundle:Course')->getCoursesByTeacher($semesterId, $id);
                
        $courseIds = Array();
        foreach($teacherCourses as $course) {
            $courseIds[] = $course->getId();
        }
        
        $teacherStudents = null;
        $teacherClassSessions = null;
        if (count($courseIds) > 0) {
            $teacherStudents = $em->getRepository('VirguleMainBundle:Student')->loadAllEnrolledInCourses($courseIds);         
            $teacherClassSessions = $em->getRepository('VirguleMainBundle:ClassSession')->loadAllClassSessionByTeacher($semesterId, $id);
        }
        
        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),            
            'teacherCourses' => $teacherCourses,
            'teacherStudents' => $teacherStudents,
            'teacherClassSessions' => $teacherClassSessions
        );
    }

    /**
     * Displays a form to create a new Teacher entity.
     *
     * @Route("/new", name="teacher_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Teacher();
        $form = $this->createForm(new TeacherType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Teacher entity.
     *
     * @Route("/create", name="teacher_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:Teacher:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Teacher();
        $form = $this->createForm(new TeacherType(), $entity);
        $form->bind($request);        
        
        $temporary_password = $this->getTeacherManager()->generatePassword();
        $entity->setPlainPassword($temporary_password);
        
        $now = new \DateTime('now');
        $entity->setRegistrationDate($now);
        $credentialsExpirationDate = $now;
        $tempCredentialsDays = $this->container->getParameter('temporary_credentials_days');
        $credentialsExpirationDate->modify('+' . $tempCredentialsDays . ' day');
        $entity->setCredentialsExpireAt($credentialsExpirationDate);
        
        $expirationDate = $now;
        $daysBeforeExpiration = $this->container->getParameter('user_account_days_before_expiration');
        $expirationDate->modify('+' . $daysBeforeExpiration . ' day');
        $entity->setExpiresAt($expirationDate);
        
        $em = $this->getDoctrine()->getManager();
        $currentBranchId = $this->getSelectedOrganizationBranch()->getId();
        $organizationBranch = $em->getRepository('VirguleMainBundle:OrganizationBranch')->find($currentBranchId);
        $entity->addOrganizationBranch($organizationBranch);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
                            
            $site_adress = $this->container->getParameter('site_adress');
        
            $parameters = array('firstname'     => $entity->getFirstName(), 
                'username'                      => $entity->getUsername(),
                'temporary_password'            => $temporary_password, 
                'temporary_credentials_days'    => $tempCredentialsDays,
                'site_adress'                   => $site_adress);
            
            $this->sendMessage($entity->getEmail(), 'CRf 03/10 - AALF : compte créé', 'VirguleMainBundle:Teacher:new.mail.twig', $parameters);

            $this->addFlash( 'Compte utilisateur <strong>' . $entity->getUsername() . '</strong> créé avec succès ! Les informations de connexion ont été envoyées à <strong>' . $entity->getEmail() . '</strong>');
            
            return $this->redirect($this->generateUrl('teacher_index'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Teacher entity.
     *
     * @Route("/{id}/edit", name="teacher_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, $id) {
        $securityContext = $this->get('security.context');

        // check for edit access
        if ($this->getConnectedUser()->getId() == $id || true === $securityContext->isGranted('ROLE_SECRETARY')) {
            
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('VirguleMainBundle:Teacher')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Teacher entity.');
            }
            $editForm = $this->createForm(new TeacherType('edit'), $entity);
            $deleteForm = $this->createDeleteForm($id);

            if ($request->isMethod('POST')) {                
                $editForm->bind($request);
                
                if ($editForm->isValid()) {
                    $em->persist($entity);
                    $em->flush();

                    $this->addFlash( 'Le profil de <strong>' . $entity->getFullName()  . '</strong> a été mis à jour.');
                    
                    return $this->redirect($this->generateUrl('teacher_show', array('id' => $id)));
                }
            }
            return array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            );
        } else {
            throw new AccessDeniedException();
        }
    }

    /**
     * Deletes a Teacher entity.
     *
     * @Route("/{id}/delete", name="teacher_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VirguleMainBundle:Teacher')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Teacher entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('teacher_index'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
    
    /**
     * Unlock an account, and reset credentials
     * @Route("/{id}/unlock", name="teacher_unlock")
     *@Template("VirguleMainBundle:Teacher:show.html.twig")
     */
    public function unlockAction(Teacher $teacher) {
        $temporary_password = $this->getTeacherManager()->reactivateAccount($teacher);
                
        $tempCredentialsDays = $this->container->getParameter('temporary_credentials_days');
                
        $parameters = array('firstname'                   => $teacher->getFirstName(), 
            'username'                      => $teacher->getUsername(),
            'temporary_password'            => $temporary_password, 
            'temporary_credentials_days'    => $tempCredentialsDays);
        $this->sendMessage($teacher->getEmail(), 'CRf 03/10 - AALF : compte réactivé', 'VirguleMainBundle:Teacher:temporary_pwd.mail.twig', $parameters);
        
        $this->addFlash( 'Le profil de <strong>' . $teacher->getFullName()  . '</strong> a été débloqué etun mot de passe temporaire lui a été attribué.');
            
        return $this->redirect($this->generateUrl('teacher_show', array('id' => $teacher->getId())));
    }   
    
    private function sendMessage($to, $subject, $template, $parameters) {
        $contactEmailAdress = $this->container->getParameter('contact_email_address');
        
        $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($this->getUser()->getEmail())
                ->setTo($to)
                ->setCc($contactEmailAdress)
                ->setBody($this->renderView($template, $parameters));
                
        $this->get('mailer')->send($message);
    }
}
