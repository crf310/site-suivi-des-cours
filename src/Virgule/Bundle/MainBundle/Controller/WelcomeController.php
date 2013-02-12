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
class WelcomeController extends AbstractVirguleController {

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
        $semesterId = $this->getSelectedSemesterId();
        $myCourses = $em->getRepository('VirguleMainBundle:Course')->getCoursesByTeacher($semesterId, $teacherId);
        
        $courseIds = Array();
        foreach($myCourses as $course) {
            $courseIds[] = $course->getId();
        }
        
        $myStudents = $em->getRepository('VirguleMainBundle:Student')->loadAllEnrolledInCourses($courseIds);
        $nbMyStudents=count($myStudents);
        
        $myClassSessions = $em->getRepository('VirguleMainBundle:ClassSession')->loadAllClassSessionByTeacher($semesterId, $teacherId, 5);
        $latestClassSessions = $em->getRepository('VirguleMainBundle:ClassSession')->loadAll($semesterId, 10);
        
        return array(
            'myCourses' => $myCourses,
            'myStudents' => $myStudents,
            'nbMyStudents' => $nbMyStudents,
            'myClassSessions' => $myClassSessions,
            'latestClassSessions' => $latestClassSessions
        );
    }
}
