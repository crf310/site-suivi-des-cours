<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\OpenHouse;
use Virgule\Bundle\MainBundle\Form\Type\OpenHouseType;

/**
 * OpenHouse controller.
 *
 * @Route("/openhouse")
 */
class OpenHouseController extends AbstractVirguleController {

  /**
   * Creates a new OpenHouse entity.
   *
   * @Route("/", name="openhouse_create")
   * @Method("POST")
   * @Template("VirguleMainBundle:OpenHouse:new.html.twig")
   */
  public function createAction(Request $request) {
    $entity = new OpenHouse();
    $form = $this->createForm(new OpenHouseType(), $entity);
    $form->bind($request);

    $entity->setSemester($this->getSelectedSemester());

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($entity);
      $em->flush();

      $this->addFlash('Journée d\'accueil créée avec succès !');

      return $this->redirect($this->generateUrl('semester_index'));
    }

    return array(
        'entity' => $entity,
        'form' => $form->createView(),
    );
  }

  /**
   * Displays a form to create a new OpenHouse entity.
   *
   * @Route("/new", name="openhouse_new")
   * @Method("GET")
   * @Template()
   */
  public function newAction() {
    $entity = new OpenHouse();
    $form = $this->createForm(new OpenHouseType(), $entity);

    return array(
        'entity' => $entity,
        'form' => $form->createView(),
    );
  }

}
