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
            $course['alternateEnddate'], $course['alternateEnddate'], $course['nb_students'], $course['classlevel_id'], 
            $course['classlevel_name'], $course['classlevel_colorcode'], $teachers_array[$course['course_id']], $course['classroom_id'], $course['classroom_name']);
            $coursesHydrated[] = $courseHydrated;
        }
        return $coursesHydrated;
    }

}

?>