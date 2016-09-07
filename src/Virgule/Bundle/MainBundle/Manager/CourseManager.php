<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\Course;
use \Virgule\Bundle\MainBundle\Entity\Student;
use \Virgule\Bundle\MainBundle\Entity\CourseHydrated;

class CourseManager extends BaseManager {

  protected $em;

  public function __construct(EntityManager $em) {
    $this->em = $em;
  }

  public function getRepository() {
    return $this->em->getRepository('VirguleMainBundle:Course');
  }

  /**
   * 
   * @param \Virgule\Bundle\MainBundle\Entity\Course $courseId
   * @param \Virgule\Bundle\MainBundle\Manager\Student $studentId
   * @param type $enrollment
   */
  public function enrollmentAction(Course $courseId, Student $studentId, $enrollment = true) {
    if ($enrollment) {
      $courseId->addStudent($studentId);
    } else {
      $courseId->removeStudent($studentId);
    }

    $this->em->persist($courseId);
    $this->em->flush();

    return true;
  }

  public function getNumberOfOverlappingCourses(Course $course) {
    $courseId = $course->getId();
    $semesterId = $course->getSemester()->getId();
    $dayOfWeek = $course->getDayOfWeek();
    $classRoomId = $course->getClassRoom()->getId();
    $startTime = $course->getStartTime();
    $endTime = $course->getEndTime();

    $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
    return $result['nb_courses'];
  }

  /**
   * Get all useful information from related entities
   * and group teachers
   * @param type $semesterId
   */
  public function getAllHydratedCourses($semesterId, $classRoomIds = null) {
    $coursesHydrated = Array();
    $courses = $this->getRepository()->loadAll($semesterId, $classRoomIds);

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
      $courseHydrated = new CourseHydrated($course['course_id'], $course['dayOfWeek'], $course['startTime'], $course['endTime'], $course['alternateStartdate'], $course['alternateEnddate'], $course['nb_students'], $course['classlevel_id'], $course['classlevel_name'], $course['classlevel_colorcode'], $teachers_array[$course['course_id']], $course['classroom_id'], $course['classroom_name']);
      $coursesHydrated[] = $courseHydrated;
    }
    return $coursesHydrated;
  }

  private function cloneCourse($course, $newSemester) {
    $newCourse = clone $course;
    $newCourse->setSemester($newSemester);
    $this->em->persist($newCourse);
    $this->em->flush();

    foreach ($course->getTeachers() as $teacher) {
      $newCourse->addTeacher($teacher);
    }
    $this->em->persist($newCourse);
    $this->em->flush();

    return $newCourse->getId();
  }

  public function cloneCourses($courseIds, $newSemester) {
    $courses = $this->getRepository()->findByIds($courseIds);
    foreach ($courses as $course) {
      $this->cloneCourse($course, $newSemester);
    }
  }

  public function getNumberOfEnrolledStudents($courseIds) {
    return $courses = $this->getRepository()->getNumberOfEnrolledStudents($courseIds);
  }

}

?>
