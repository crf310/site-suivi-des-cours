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
        $myStudentsLineBreak = $this->getListBreak($nbMyStudents, 3);
        
        $myClassSessions = $em->getRepository('VirguleMainBundle:ClassSession')->loadAllClassSessionByTeacher($semesterId, $teacherId, 5);
        $myClassSessionsLineBreak = $this->getListBreak(count($myClassSessions));

        $latestClassSessions = $em->getRepository('VirguleMainBundle:ClassSession')->loadAll($semesterId, 10);
        $latestClassSessionsLineBreak = $this->getListBreak(count($latestClassSessions));        
        
        return array(
            'myCourses' => $myCourses,
            'myStudents' => $myStudents,
            'nbMyStudentsLineBreak' => $myStudentsLineBreak,
            'nbMyStudents' => $nbMyStudents,
            'myClassSessions' => $myClassSessions,
            'myClassSessionsLineBreak' => $myClassSessionsLineBreak,
            'latestClassSessions' => $latestClassSessions,
            'latestClassSessionsLineBreak' => $latestClassSessionsLineBreak
        );
    }
}
