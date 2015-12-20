<?php

namespace Virgule\Bundle\MainBundle\Tests\Manager;

use Virgule\Bundle\MainBundle\Tests\AbstractTest;

class TeacherManagerTest extends AbstractTest {

  private $NB_ACTIVE_TEACHERS = 2;
  private $NB_INACTIVE_TEACHERS = 5;
  private $ORG_BRANCH_ID = 1;
  private $SEMESTER_ID = 1;

  private function getManager() {
    return $this->getApplication()->getKernel()->getContainer()->get('virgule.teacher_manager');
  }

  /**
   * @test
   */
  public function getInactiveTeachers_someTeachersHaveNoCourse_teachersWithoutCoursesAreReturned() {
    $results = $this->getManager()->getTeachersWithoutCourses($this->ORG_BRANCH_ID, $this->SEMESTER_ID);
    $this->assertEquals($this->NB_INACTIVE_TEACHERS, count($results));

    foreach ($results as $teacher) {
      $org_branches = $teacher->getOrganizationBranches();
      $this->assertEquals($this->ORG_BRANCH_ID, $org_branches[0]->getId());
    }
  }

  /**
   * @test
   */
  public function getTeachersWithCourses_someTeachersHaveCourses_teachersWithCoursesAreReturned() {
    $results = $this->getManager()->getTeachersWithCourses($this->ORG_BRANCH_ID, $this->SEMESTER_ID);

    $this->assertEquals($this->NB_ACTIVE_TEACHERS, count($results));
    foreach ($results as $teacher) {
      $org_branches = $teacher->getOrganizationBranches();
      $this->assertEquals($this->ORG_BRANCH_ID, $org_branches[0]->getId());
    }
  }

  /**
   * @test
   */
  public function getNumberOfTeachersWithoutCourses() {
    $result = $this->getManager()->getNumberOfTeachersWithoutCourses($this->ORG_BRANCH_ID, $this->SEMESTER_ID);
    $this->assertEquals($this->NB_INACTIVE_TEACHERS, $result);
  }

  /**
   * @test
   */
  public function getNumberOfTeachersWithCourses() {
    $result = $this->getManager()->getNumberOfTeachersWithCourses($this->ORG_BRANCH_ID, $this->SEMESTER_ID);

    $this->assertEquals($this->NB_ACTIVE_TEACHERS, $result);
  }

}

?>
