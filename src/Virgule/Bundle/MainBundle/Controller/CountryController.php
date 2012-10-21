<?php

namespace Virgule\Bundle\MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\Country;

/**
 * Country controller.
 *
 * @Route("/country")
 */
class CountryController extends Controller
{
    /**
     * Lists all Country entities.
     *
     * @Route("/", name="country")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VirguleMainBundle:Country')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Country entity.
     *
     * @Route("/{id}/show", name="country_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VirguleMainBundle:Country')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Country entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
