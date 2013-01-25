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
        $logger = $this->get('logger');
        
        $em = $this->getDoctrine()->getManager();
        $teacherId = $this->getUser()->getId();
        
        $myCourses = $em->getRepository('VirguleMainBundle:Course')->getCoursesByTeacher($teacherId);
        
        $courseIds = Array();
        foreach($myCourses as $course) {
            $courseIds[] = $course->getId();
            $logger->debug('Welcome page: course ID ' . $course->getId() . 'found');
        }
        $myStudents = $em->getRepository('VirguleMainBundle:Student')->loadAllEnrolledInCourses($courseIds);
        $nbMyStudents=count($myStudents);
        
        return array(
            'myCourses' => $myCourses,
            'myStudents' => $myStudents,
            'nbMyStudents' => $nbMyStudents
        );
    }
}
