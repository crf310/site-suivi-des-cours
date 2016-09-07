<?php

namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;
use Virgule\Bundle\MainBundle\Entity\Semester;

class SemesterRepositoryTest extends AbstractRepositoryTest {

  private $ORG_BRANCH_ID = 1;

  private function getCurrentDate() {
    $now = new \DateTime('now');
    $now = $now->format("Y-m-d");
    return $now;
  }

  private function getRepository() {
    return self::$_em->getRepository('VirguleMainBundle:Semester');
  }

  /**
   * @test
   * @expectedException \Doctrine\ORM\NoResultException
   */
  public function loadCurrent_organizationBranchWithoutSemester_noResultExceptionThrown() {
    $result = $this->getRepository()->loadCurrent(time());
    $this->assertEquals(0, count($result), "A semester has been found");
  }

  /**
   * @test
   */
  public function loadCurrent_currentDateBetweenStartAndEndDates_currentSemesterReturned() {
    $result = $this->getRepository()->loadCurrent($this->ORG_BRANCH_ID);
    $this->assertEquals(1, count($result), "More than one semester has been returned");

    $this->assertEquals($this->ORG_BRANCH_ID, $result->getOrganizationBranch()->getId(), "Returned semester is from the wrong organization branch");
    $this->assertTrue($this->getCurrentDate() >= $result->getStartDate()->format("Y-m-d"), "Semester start date is not before the current date");
    $this->assertTrue($this->getCurrentDate() <= $result->getEndDate()->format("Y-m-d"), "Semester end date is not after the current date");
  }

  /**
   * @test
   */
  public function loadCurrent_currentDateEqualsStartDate_currentSemesterReturned() {
    $orgBranchId = 2;
    $result = $this->getRepository()->loadCurrent($orgBranchId);
    $this->assertEquals(1, count($result), "More than one semester has been returned");

    $this->assertEquals($orgBranchId, $result->getOrganizationBranch()->getId(), "Returned semester is from the wrong organization branch");
    $this->assertTrue($this->getCurrentDate() == $result->getStartDate()->format("Y-m-d"), "Semester start date is not equal to the current date");
    $this->assertTrue($this->getCurrentDate() <= $result->getEndDate()->format("Y-m-d"), "Semester end date is not after the current date");
  }

  /**
   * @test
   */
  public function loadCurrent_currentDateEqualsEndDate_currentSemesterReturned() {
    $orgBranchId = 3;
    $result = $this->getRepository()->loadCurrent($orgBranchId);
    $this->assertEquals(1, count($result), "More than one semester has been returned");

    $this->assertEquals($orgBranchId, $result->getOrganizationBranch()->getId(), "Returned semester is from the wrong organization branch");
    $this->assertTrue($this->getCurrentDate() >= $result->getStartDate()->format("Y-m-d"), "Semester start date is not before the current date");
    $this->assertTrue($this->getCurrentDate() == $result->getEndDate()->format("Y-m-d"), "Semester end date is not equal to the current date");
  }

  /**
   * @test
   */
  public function loadAll_currentDateBetweenStartAndEndDates_allSemestersReturned() {
    $results = $this->getRepository()->loadAll($this->ORG_BRANCH_ID);
    $this->assertEquals(2, count($results), "Not all semesters have been found");

    foreach ($results as $semester) {
      $this->assertEquals($this->ORG_BRANCH_ID, $semester->getOrganizationBranch()->getId(), "Returned semester is from the wrong organization branch");
    }
  }

  /**
   * @test
   */
  public function getPreviousSemester_currentDateAfterEndDate_previousSemesterReturned() {
    $result = $this->getRepository()->getPreviousSemester($this->ORG_BRANCH_ID, $this->getCurrentDate());
    $this->assertEquals(1, count($result), "More than one semester has been returned");

    $this->assertEquals($this->ORG_BRANCH_ID, $result->getOrganizationBranch()->getId(), "Returned semester is from the wrong organization branch");
    $this->assertTrue($this->getCurrentDate() > $result->getStartDate()->format("Y-m-d"), "Semester start date is not before the current date");
    $this->assertTrue($this->getCurrentDate() > $result->getEndDate()->format("Y-m-d"), "Semester end date is not before the current date");
  }

  /**
   * @test
   */
  public function loadLatest_latestSemesterIsCurrentSemester_currentAndLatestAreEquals() {
    $currentSemester = $this->getRepository()->loadCurrent($this->ORG_BRANCH_ID);

    $result = $this->getRepository()->loadLatest($this->ORG_BRANCH_ID);
    $this->assertEquals(1, count($result), "More than one semester has been returned");

    $this->assertEquals($this->ORG_BRANCH_ID, $result->getOrganizationBranch()->getId(), "Returned semester is from the wrong organization branch");
    $this->assertEquals($currentSemester, $result);
  }

  /**
   * @test
   * @expectedException \Doctrine\ORM\NoResultException
   */
  public function loadLatest_organizationBranchWithoutSemester_noResultExceptionThrown() {
    $result = $this->getRepository()->loadLatest(time());
    $this->assertEquals(0, count($result), "A semester has been found");
  }

  /**
   * @test
   */
  public function getNumberOfSemesterNotFinishedAtGivenDate_dateParameterIsBeforeEndDateOfASemester_resultIsOne() {
    $searchedDate = new \DateTime();
    $searchedDate->modify('-10 day');

    $nbUnfinishedSemester = $this->getRepository()->getNumberOfSemesterNotFinishedAtGivenDate($this->ORG_BRANCH_ID, $searchedDate);
    $this->assertEquals(1, $nbUnfinishedSemester);
  }

    /**
   * @test
   */
  public function getNumberOfSemesterNotFinishedAtGivenDate_dateParameterIsAfterEndDateOfAnySemester_resultIsZero() {
    $searchedDate = new \DateTime();
    $searchedDate->modify('+10000 day');

    $nbUnfinishedSemester = $this->getRepository()->getNumberOfSemesterNotFinishedAtGivenDate($this->ORG_BRANCH_ID, $searchedDate);
    $this->assertEquals(0, $nbUnfinishedSemester);
  }
}

?>
