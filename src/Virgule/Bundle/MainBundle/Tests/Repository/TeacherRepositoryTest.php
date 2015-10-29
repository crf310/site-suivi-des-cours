<?php
// src/Acme/ProductBundle/Tests/Entity/ProductRepositoryFunctionalTest.php
namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

class TeacherRepositoryTest extends AbstractRepositoryTest {

    private $ORG_BRANCH_ID = 1;

    /**
     * @test
     */
    public function getTeacherByStatus_activeIsFalse_inactiveTeacherFound() {
        $results = $this->_em->getRepository('VirguleMainBundle:Teacher')->getTeachersByStatus($this->ORG_BRANCH_ID, true);
        $this->assertEquals(6, count($results));
        foreach ($results as $teacher) {
            $this->assertTrue($teacher->getIsActive());
            $org_branches = $teacher->getOrganizationBranches();
            $this->assertEquals($this->ORG_BRANCH_ID, $org_branches[0]->getId());
        }
    }

    /**
     * @test
     */
    public function getTeacherByStatus_activeIsTrue_activeTeachersFound() {
        $results = $this->_em->getRepository('VirguleMainBundle:Teacher')->getTeachersByStatus($this->ORG_BRANCH_ID, false);

        $this->assertEquals(1, count($results));
        foreach ($results as $teacher) {
            $this->assertFalse($teacher->getIsActive());
            $org_branches = $teacher->getOrganizationBranches();
            $this->assertEquals($this->ORG_BRANCH_ID, $org_branches[0]->getId());
        }
    }

    /**
     * @test
     */
    public function getNbTeacherByStatus_activeIsFalse_numberOfInactiveTeachersFound() {
        $result = $this->_em->getRepository('VirguleMainBundle:Teacher')
        ->getNbTeachersByStatus($this->ORG_BRANCH_ID, false);

        $this->assertEquals(1, $result['nb_teachers']);
    }

    /**
     * @test
     */
    public function getNbTeacherByStatus_activeIsTrue_numberOfActiveTeachersFound() {
        $result = $this->_em->getRepository('VirguleMainBundle:Teacher')->getNbTeachersByStatus($this->ORG_BRANCH_ID, true);

        $this->assertEquals(6, $result['nb_teachers']);
    }
}
?>
