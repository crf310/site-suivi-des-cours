<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Statistics controller.
 *
 * @Route("/stats")
 */
class StatisticsController extends AbstractVirguleController {

    /**
     * Display global statistics
     *
     * @Route("/", name="stats_index")
     * @Template()
     */
    public function indexAction() {         
        $em = $this->getDoctrine()->getManager();

        $semesterId = $this->getSelectedSemesterId();
        $students = $em->getRepository('VirguleMainBundle:Student')->getStudentsInformation($semesterId);
        
        $total_students = 0;
        $students_genders['F'] = 0;
        $students_genders['M'] = 0;
        $students_countries = Array();
        foreach ($students as $student) {
            $students_genders[$student['student_gender']] += 1;
            
            if (! array_key_exists($student['country_code'], $students_countries)) {
                $students_countries[$student['country_code']]['country_code'] = $student['country_code'];
                $students_countries[$student['country_code']]['nb_students'] = 0;
                $students_countries[$student['country_code']]['country_label'] = $student['country_label'];
            }
            $students_countries[$student['country_code']]['nb_students'] += 1;
            $total_students += 1;
        }
        
        return array(
            'students_genders' => $students_genders, 
            'total_students' => $total_students,
            'students_countries' => $students_countries);
    }
}

