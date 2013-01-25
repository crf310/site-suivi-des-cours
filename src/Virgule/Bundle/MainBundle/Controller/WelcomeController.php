<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Welcome controller.
 *
 * @Route("/")
 */
class WelcomeController extends Controller {

    /**
     * Display log file
     *
     * @Route("/welcome", name="welcome")
     * @Template
     */
    public function welcomeAction() {
        $em = $this->getDoctrine()->getManager();
        $teacherId = $this->getUser()->getId();
        
        $myCourses = $em->getRepository('VirguleMainBundle:Course')->getCoursesByTeacher($teacherId);
        
        return array(
            'myCourses'=> $myCourses
        );
    }
}
