<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\Course;
use \Virgule\Bundle\MainBundle\Entity\CourseHydrated;

class CourseManager extends BaseManager {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository('VirguleMainBundle:Course');
    }

    public function getNumberOfOverlappingCourses(Course $course) {

        $semesterId = $course->getSemester()->getId();
        $dayOfWeek = $course->getDayOfWeek();
        $classRoomId = $course->getClassRoom()->getId();
        $startTime = $course->getStartTime();
        $endTime = $course->getEndTime();

        $result = $this->getRepository()->getNumberOfOverlappingCourses($semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
        return $result['nb_courses'];
    }

    /**
     * Get all useful information from related entities
     * and group teachers
     * @param type $semesterId
     */
    public function getAllHydratedCourses($semesterId) {
        $coursesHydrated = Array();
        $courses = $this->getRepository()->loadAll($semesterId);

        // sub array to group multiple teachers      
        $course_ids = Array();
        $teachers_array = Array();
        foreach ($courses as $key => $course) {
            $teachers_array[$course['course_id']][] = Array('teacher_id' => $course['teacher_id'],
                'teacher_firstName' => $course['teacher_firstName'],
                'teacher_lastName' => $course['teacher_lastName']);

            // delete doubled
            if (array_key_exists($course['course_id'], $course_ids)) {
                unset($courses[$key]);
            }
            $course_ids[$course['course_id']] = 1;
        }
        
        foreach ($courses as $course) {
            $courseHydrated = new CourseHydrated($course['course_id'], $course['dayOfWeek'], $course['startTime'], $course['endTime'], 
            $course['alternateStartdate'], $course['alternateEnddate'], $course['nb_students'], $course['classlevel_id'], 
            $course['classlevel_name'], $course['classlevel_colorcode'], $teachers_array[$course['course_id']], $course['classroom_id'], $course['classroom_name']);
            $coursesHydrated[] = $courseHydrated;
        }
        return $coursesHydrated;
    }
    
    private function cloneCourse($course, $newSemester) {
        $newCourse = clone $course;
        $newCourse->setSemester($newSemester);
        $this->em->persist($newCourse);
        $this->em->flush();

        foreach($course->getTeachers() as $teacher) {
            $newCourse->addTeacher($teacher);
        }
        $this->em->persist($newCourse);
        $this->em->flush();
        
        return $newCourse->getId();
    }
    
    public function cloneCourses($courseIds, $newSemester) {
        $courses = $this->getRepository()->findByIds($courseIds);
        foreach($courses as $course) {
            $this->cloneCourse($course, $newSemester);
        }
    }
    
    // one shot
    public function fixCourses() {
        
        $semesterRepository = $this->em->getRepository('VirguleMainBundle:Semester');
        
        // sélectionner les cours du semestre qui ont des compte-rendus avec une date antérieure
        $courses = $this->getRepository()->getCourseWithOldReports();
        
        // sélectionner le semestre correspondant
        foreach($courses as $course) {
            echo 'Processing course #' . $course->getId() . "<br />";
            $semestersFound = Array();
            $coursesCloned = Array();
            foreach($course->getClassSessions() as $classession) {
                
                if (date_format($classession->getSessionDate(), 'Y-m-d') > '2008-09-22') {
                    
                    $sessionDate = date_format($classession->getSessionDate(), 'Y-m-d');
                    $semesterStartDate = date_format($classession->getCourse()->getSemester()->getStartDate(), 'Y-m-d');
                    if ($sessionDate < $semesterStartDate) {
                        
                        echo 'Looking for a semester containing '. date_format($classession->getSessionDate(), 'd/m/Y') . "<br />";
                        $s = $semesterRepository->findSemesterByDateBetween($classession->getSessionDate());

                        if ($s != null) {
                            echo "Semester found : #" . $s->getId() . "<br />";
                            // cloner le cours
                             if (! in_array($s->getId(), $semestersFound)) {
                                 $newCourseId = $this->cloneCourse($course, $s);
                                 $newCourse = $this->getRepository()->find($newCourseId);
                                 $semestersFound[] = $s->getId();
                                 $coursesCloned[$course->getId()] = $newCourseId;
                                 echo "Cours #" . $course->getId() . " cloned to #" . $newCourseId . ".<br />";
                             } else {                     
                                 $newCourse = $this->getRepository()->find($coursesCloned[$course->getId()]);
                             }

                            $classession->setCourse($newCourse);
                            echo "Class session #" . $classession->getId() . " attached to course #" . $newCourse->getId() . ".<br />";
                            $this->em->persist($classession);
                            $this->em->flush();
                        } else {
                            echo "No semester found <br />";
                        }
                    }
                }
            }
            echo "<br />";
        }
        
        // s'ils ont aussi d'autres comptes-rendus, cloner le cours
        
        // sinon déplacer
        
        // boucler sur ces comptes-rendus et changer le cours
        
        // sauver cours et comptes-rendus
    }
}

?>