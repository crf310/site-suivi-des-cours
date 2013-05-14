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
        
        $form = $this->createForm(new ClassLevelSuggestedType(), $entity, Array('em' => $this->getDoctrineManager()));
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('student_show', array('id' => $entity->getStudent()->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
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
