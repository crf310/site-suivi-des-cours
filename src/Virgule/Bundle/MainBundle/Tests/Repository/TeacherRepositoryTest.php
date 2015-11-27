<?php
namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

class TeacherRepositoryTest extends AbstractRepositoryTest {

    private $NB_ACTIVE_TEACHERS = 5;

    private $NB_INACTIVE_TEACHERS = 2;

    private $ORG_BRANCH_ID = 1;

    private function getRepository() {
        return self::$_em->getRepository('VirguleMainBundle:Teacher');
    }

    /**
     * @test
     */
    public function getTeacherByStatus_activeIsFalse_inactiveTeachersFound() {
        $results = $this->getRepository()->getTeachersByStatus($this->ORG_BRANCH_ID, false);
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
        $results = $this->getRepository()->getTeachersByStatus($this->ORG_BRANCH_ID, true);

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
        $result = $this->getRepository()->getNbTeachersByStatus($this->ORG_BRANCH_ID, false);

        $this->assertEquals($this->NB_INACTIVE_TEACHERS, $result['nb_teachers']);
    }

    /**
     * @test
     */
    public function getNbTeacherByStatus_activeIsTrue_numberOfActiveTeachersFound() {
        $result = $this->getRepository()->getNbTeachersByStatus($this->ORG_BRANCH_ID, true);

        $this->assertEquals($this->NB_ACTIVE_TEACHERS, $result['nb_teachers']);
    }
}
?>
