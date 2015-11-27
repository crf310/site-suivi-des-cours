<?php
namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

class ClassRoomRepositoryTest extends AbstractRepositoryTest {

    private $ORG_BRANCH_ID = 1;

    private function getRepository() {
        return self::$_em->getRepository('VirguleMainBundle:ClassRoom');
    }

    /**
     * @test
     */
    public function getClassRoomsForOrganizationBranch_organizationBranchHasClassRooms_allClassRoomsReturnedAndBelongsToOrgBranch() {
        $results = $this->getRepository()->getClassRoomsForOrganizationBranch($this->ORG_BRANCH_ID);
        $this->assertEquals(2, count($results), "More or less classrooms than expected have been returned");

        foreach ($results as $classroom) {
            $this->assertEquals($this->ORG_BRANCH_ID, $classroom['classroom_organization_branch'], "Returned classroom is from the wrong organization branch");
            $this->assertNotNull($classroom['classroom_name']);
            $this->assertNotNull($classroom['classroom_name']);
        }
    }
}
?>
