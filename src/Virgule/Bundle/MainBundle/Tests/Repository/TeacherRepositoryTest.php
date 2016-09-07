<?php

namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

class TeacherRepositoryTest extends AbstractRepositoryTest {

  private function getRepository() {
    return self::$_em->getRepository('VirguleMainBundle:Teacher');
  }
  
  /**
   * @test
   */
  public function getTeachers_organizationBranchIdProvided_queryBuilderReturned() {
    $expectedDql = 'SELECT t FROM Virgule\Bundle\MainBundle\Entity\Teacher t ';
    $expectedDql .= 'INNER JOIN t.organizationBranches ob WITH ob.id = :organizationBranchId ';
    $expectedDql .= 'WHERE t.username <> :rootUsername ';
    $expectedDql .= 'ORDER BY t.lastName ASC, t.firstName ASC';

    $queryBuilder = $this->getRepository()->getTeachers(0);
  
    $this->assertEquals($expectedDql, $queryBuilder->getDQL());
  }
}

?>
