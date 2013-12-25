<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\ClassLevelSuggested;
use Virgule\Bundle\MainBundle\Form\ClassLevelSuggestedType;

/**
 * ClassLevelSuggested controller.
 *
 * @Route("/classlevelsuggested")
 */
class ClassLevelSuggestedController extends AbstractVirguleController {

    /**
     * Creates a new ClassLevelSuggested entity.
     *
     * @Route("/", name="classlevelsuggested_create")
     * @Method("POST")
     * @Template("VirguleMainBundle:ClassLevelSuggested:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new ClassLevelSuggested();
        $entity->setDateOfChange(new \DateTime('now'));
        $entity->setChanger($this->getUser());
        
        $form = $this->createForm(new ClassLevelSuggestedType($this->getDoctrineManager()), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            // checks that we change to another class level than the current one
            $currentClassLevel = $this->getClassLevelSuggestedRepository()->getCurrentClassLevelSuggested($entity->getStudent()->getId());
            if (null === $currentClassLevel || ($currentClassLevel->getClassLevel()->getId() != $entity->getClassLevel()->getId())) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();   
                
                $flashMessage = 'Le niveau de <strong>' . $entity->getStudent()->getFirstname() . ' ' . $entity->getStudent()->getLastname() . '</strong> a bien été passé à <strong>' . $currentClassLevel->getClassLevel()->getLabel() . '</strong>';
                $this->addFlash($flashMessage);
            }
        }        
        
        return $this->redirect($this->generateUrl('student_show', array('id' => $entity->getStudent()->getId())));
    }

    /**
     * Displays a form to create a new ClassLevelSuggested entity.
     *
     * @Route("/new", name="classlevelsuggested_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new ClassLevelSuggested();
        $form = $this->createForm(new ClassLevelSuggestedType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

}
