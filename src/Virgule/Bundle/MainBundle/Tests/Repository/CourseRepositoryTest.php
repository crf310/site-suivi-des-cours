<?php
namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

class CourseRoomRepositoryTest extends AbstractRepositoryTest {

    private function getRepository() {
        return $this->_em->getRepository('VirguleMainBundle:Course');
    }

    /**
     * @test
     */
    public function getNumberOfCourse_semesterHasThreeCourses_threeCourseReturned() {
      $result = $this->getRepository()->getNumberOfCourse(1);
      $this->assertEquals(3, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getCoursesByTeacher_teacherhasTwoCoursesForThisSemester_threeCoursesReturned() {
      $semesterId = 1;
      $teacherId = 2;

      $results = $this->getRepository()->getCoursesByTeacher($semesterId, $teacherId);
      $this->assertEquals(2, count($results), "Incorrect number of courses found");
      foreach ($results as $course) {
        $this->assertTrue($course->getSemester()->getId() == 1, 'Returned course is from a different semester');
        $teacherFound = false;
        foreach ($course->getTeachers() as $teacher) {
          if ($teacher->getId() == $teacherId) {
            $teacherFound = true;
          }
        }
        $this->assertTrue($teacherFound);
      }
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_newCourseEndTimeEqualsStoredCoursedStartTime_resultIsZero() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0700');
      $endTime = new \DateTime('0800');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(0, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_newCourseStartTimeEqualsStoredCoursedStartTime_resultIsOne() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0800');
      $endTime = new \DateTime('0900');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(1, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_newCourseEndTimeEqualsStoredCoursedEndTime_resultIsOne() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0830');
      $endTime = new \DateTime('0930');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(1, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_newCourseStartTimeEqualsStoredCoursedEndTime_resultIsZero() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0930');
      $endTime = new \DateTime('1000');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(0, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_newCourseHoursContainsStoredCourseHours_resultIsOne() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0700');
      $endTime = new \DateTime('1000');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(1, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_newCourseHoursAreContainedInStoredCourseHours_resultIsOne() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0815');
      $endTime = new \DateTime('0915');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(1, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_newCourseHoursAreTheSameThanStoredCourseHours_resultIsOne() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0800');
      $endTime = new \DateTime('0930');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(1, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_courseHasSamePropertiesButHasDifferentRoom_resultIsZero() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0800');
      $endTime = new \DateTime('0930');
      $classRoomId = 2;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(0, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_courseHasSamePropertiesButHasDifferentDay_resultIsZero() {
      $courseId = 222222;
      $semesterId = 1;
      $dayOfWeek = 6;
      $startTime = new \DateTime('0800');
      $endTime = new \DateTime('0930');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(0, $result['nb_courses'], "Incorrect number of courses found");
    }

    /**
     * @test
     */
    public function getNumberOfOverlappingCourses_courseHasSamePropertiesButHasDifferentSemester_resultIsZero() {
      $courseId = 222222;
      $semesterId = 22222;
      $dayOfWeek = 1;
      $startTime = new \DateTime('0800');
      $endTime = new \DateTime('0930');
      $classRoomId = 1;

      $result = $this->getRepository()->getNumberOfOverlappingCourses($courseId, $semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime);
      $this->assertEquals(0, $result['nb_courses'], "Incorrect number of courses found");
    }

}
?>
