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
        
        $studentRepository = $em->getRepository('VirguleMainBundle:Student');
        $students = $studentRepository->getStudentsInformation($semesterId);
        
        $total_students = 0;
        $students_genders['F'] = 0;
        $students_genders['M'] = 0;
        $students_countries = Array();
        
        $now = new \DateTime('now');
        $student_ages = Array('0-15' => 0, '16-25' => 0, '26-35' => 0, '36-45' => 0, '46-55' => 0, '56-65' => 0, '66-75' => 0, '76-85' => 0, '86-95' => 0);
            
        foreach ($students as $student) {
            $students_genders[$student['student_gender']] += 1;
            
            if (! array_key_exists($student['country_code'], $students_countries)) {
                $students_countries[$student['country_code']]['country_code'] = $student['country_code'];
                $students_countries[$student['country_code']]['nb_students'] = 0;
                $students_countries[$student['country_code']]['country_label'] = $student['country_label'];
            }
            
            // age calculation
            $student_age = $student['student_birthDate']->diff($now)->format('%Y');
            if (0 <= $student_age && $student_age <= 15) {
                $student_ages['0-15']+=1;
            } else if (16 <= $student_age && $student_age <= 25) {
                $student_ages['16-25']+=1;
            } else if (26 <= $student_age && $student_age <= 35) {
                $student_ages['26-35']+=1;
            } else if (36 <= $student_age && $student_age <= 45) {
                $student_ages['36-45']++;
            } else if (46 <= $student_age && $student_age <= 55) {
                $student_ages['46-55']++;
            } else if (56 <= $student_age && $student_age <= 65) {
                $student_ages['56-65']++;
            } else if (66 <= $student_age && $student_age <= 75) {
                $student_ages['66-75']++;
            } else if (76 <= $student_age && $student_age <= 85) {
                $student_ages['76-85']++;
            } else if (86 <= $student_age && $student_age <= 95) {
                $student_ages['86-95']++;
            }

            $students_countries[$student['country_code']]['nb_students'] += 1;
            $total_students += 1;
        }
        
        $studentsWithManyEnrollments = $studentRepository->getStudentsWithManyEnrollments($semesterId);
        
        
        return array(
            'studentsWithManyEnrollments' => $studentsWithManyEnrollments,
            'students_genders' => $students_genders, 
            'total_students' => $total_students,
            'students_countries' => $students_countries,
            'students_ages' => $student_ages);
    }
}

