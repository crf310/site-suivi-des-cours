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
        $semesterId = $this->getSelectedSemesterId();
        
        $studentRepository = $this->getStudentRepository();
        $studentManager = $this->getStudentManager();
        
        $languages = $this->getLanguageRepository()->getNumberOfLanguagesSpoken($semesterId);        
        
        $students = $studentRepository->getStudentsInformation($semesterId);
        
        $total_students = 0;
        $students_genders['F'] = 0;
        $students_genders['M'] = 0;
        $students_countries = Array();
        
        $now = new \DateTime('now');
        $student_ages = Array('??' => 0, '13-18' => 0, '19-25' => 0, '26-35' => 0, '36-45' => 0, '46-55' => 0, '56-65' => 0, '66-75' => 0, '76-100' => 0);
            
        foreach ($students as $student) {
            $students_genders[$student['student_gender']] += 1;
            
            if (! array_key_exists($student['nativeCountry'], $students_countries)) {
                $students_countries[$student['nativeCountry']] = 0;
            }
            
            // age calculation
            if ($student['student_birthDate'] != null) {
                $student_age = $student['student_birthDate']->diff($now)->format('%Y');
                if (13 <= $student_age && $student_age <= 18) {
                    $student_ages['13-18']+=1;
                } else if (19 <= $student_age && $student_age <= 25) {
                    $student_ages['19-25']+=1;
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
                } else if (76 <= $student_age && $student_age <= 100) {
                    $student_ages['76-100']++;
                }
            } else {
                $student_ages['??']++;
            }

            $students_countries[$student['nativeCountry']] += 1;
            $total_students += 1;
        }
        arsort($students_countries);
        
        $studentsWithNumberOfEnrollments = $studentRepository->getNumberOfStudentsWithNumberOfEnrollments($semesterId);
        
        $nbStudentsPerClassLevel = $studentRepository->getNumberOfStudentsPerClassLevel($semesterId);
        
        $nbActiveTeachers = $this->getTeacherRepository()->getNbTeachersByStatus($this->getSelectedOrganizationBranchId(), true);
        
        $nbCourses = $this->getCourseRepository()->getNumberOfCourse($this->getSelectedSemesterId());
        
        $nbClassSessions = $this->getClassSessionRepository()->getNumberOfClassSessionsPerSemester($this->getSelectedSemesterId());
        
        $nbNewStudents = $this->getStudentManager()->getNumberOfNewStudents($this->getSelectedSemester());
        
        return array(
            'studentsWithNumberOfEnrollments'   => $studentsWithNumberOfEnrollments,
            'students_genders'              => $students_genders, 
            'total_students'                => $total_students,
            'students_countries'            => $students_countries,
            'students_ages'                 => $student_ages,
            'nbStudentsPerClassLevel'       => $nbStudentsPerClassLevel,
            'languages'                     => $languages,
            'nbActiveTeachers'              => $nbActiveTeachers,
            'nbCourses'                     => $nbCourses,
            'nbClassSessions'               => $nbClassSessions,
            'nbNewStudents'                 => $nbNewStudents
            );
    }
}

