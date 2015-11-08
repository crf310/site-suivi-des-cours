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
}
?>
