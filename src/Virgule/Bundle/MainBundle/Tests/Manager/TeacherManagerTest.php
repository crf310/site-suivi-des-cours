<?php

namespace Virgule\Bundle\MainBundle\Tests\Manager;

use Virgule\Bundle\MainBundle\Tests\AbstractTest;

class TeacherManagerTest extends AbstractTest {

  private $NB_ACTIVE_TEACHERS = 5;
  private $NB_INACTIVE_TEACHERS = 2;
  private $ORG_BRANCH_ID = 1;
  private $SEMESTER_ID = 1;

  private function getManager() {
    return $this->getApplication()->getKernel()->getContainer()->get('virgule.teacher_manager');
  }

  /**
   * @test
   */
  public function getInactiveTeachers_activeIsFalse_inactiveTeachersFound() {
    $results = $this->getManager()->getInactiveTeachers($this->ORG_BRANCH_ID, $this->SEMESTER_ID);
    $this->assertEquals($this->NB_INACTIVE_TEACHERS, count($results));

    foreach ($results as $teacher) {
      $this->assertFalse($teacher->getIsActive());
      $org_branches = $teacher->getOrganizationBranches();
      $this->assertEquals($this->ORG_BRANCH_ID, $org_branches[0]->getId());
    }
  }

  /**
   * @test
   */
  public function getTeacherByStatus_activeIsTrue_activeTeachersFound() {
    $results = $this->getManager()->getActiveTeachers($this->ORG_BRANCH_ID, $this->SEMESTER_ID);

    $this->assertEquals($this->NB_ACTIVE_TEACHERS, count($results));
    foreach ($results as $teacher) {
      $this->assertTrue($teacher->getIsActive());
      $org_branches = $teacher->getOrganizationBranches();
      $this->assertEquals($this->ORG_BRANCH_ID, $org_branches[0]->getId());
    }
  }

  /**
   * @test
   */
  public function getNbTeacherByStatus_activeIsFalse_numberOfInactiveTeachersFound() {
    $result = $this->getManager()->getInactiveTeachers($this->ORG_BRANCH_ID, $this->SEMESTER_ID);

    $this->assertEquals($this->NB_INACTIVE_TEACHERS, $result);
  }

  /**
   * @test
   */
  public function getNbTeacherByStatus_activeIsTrue_numberOfActiveTeachersFound() {
    $result = $this->getManager()->getActiveTeachers($this->ORG_BRANCH_ID, $this->SEMESTER_ID);

    $this->assertEquals($this->NB_ACTIVE_TEACHERS, $result);
  }

}

?>
