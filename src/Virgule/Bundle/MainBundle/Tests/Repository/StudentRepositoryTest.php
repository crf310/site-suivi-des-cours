<?php

namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

/**
 * @coversDefaultClass Virgule\Bundle\MainBundle\Repository\StudentRepository
 */
class StudentRepositoryTest extends AbstractRepositoryTest {

  private $semesterId = 1;

  private function getRepository() {
    return self::$_em->getRepository('VirguleMainBundle:Student');
  }

  /**
   * @test
   */
  public function getBasicQueryBuilder_queryBuilderIsCalled_queryIsCorrectlyGenerated() {
    $queryBuilder = $this->getRepository()->getBasicQueryBuilder();

    $expectedSelect1 = 's.id as student_id, s.firstname as firstname, s.lastname as lastname, s.gender as gender, s.phoneNumber as phoneNumber, s.cellphoneNumber, ';
    $expectedSelect1 .= 's.registrationDate, s.nativeCountry';
    $expectedSelect2 = 's.emergencyContactFirstname, s.emergencyContactLastname, s.emergencyContactConnectionType, s.emergencyContactPhoneNumber';

    $dqlSelectParts = $queryBuilder->getDqlPart('select');
    $this->assertTrue($dqlSelectParts[0] instanceof \Doctrine\ORM\Query\Expr\Select, 'SELECT part is not an instance of Doctrine\ORM\Query\Expr\Select');

    $dqlSelectPart1 = $dqlSelectParts[0]->getParts();
    $this->assertEquals($expectedSelect1, $dqlSelectPart1[0], 'SELECT entity part 1 is wrong');

    $dqlSelectPart2 = $dqlSelectParts[1]->getParts();
    $this->assertEquals($expectedSelect2, $dqlSelectPart2[0], 'SELECT entity part 2 is wrong');

    $dqlFromPart = $queryBuilder->getDqlPart('from');
    $this->assertTrue($dqlFromPart[0] instanceof \Doctrine\ORM\Query\Expr\From, 'FROM part is not an instance of Doctrine\ORM\Query\Expr\From');
    $this->assertEquals('Virgule\Bundle\MainBundle\Entity\Student', $dqlFromPart[0]->getFrom(), 'FROM entity part is wrong');
    $this->assertEquals('s', $dqlFromPart[0]->getAlias(), 'FROM alias part is wrong');

    $dqlOrderByPart = $queryBuilder->getDqlPart('orderBy');
    $this->assertEquals('s.lastname ASC, s.firstname ASC', $dqlOrderByPart[0], 'ORDER BY part is wrong');
  }

  /**
   * @test
   */
  public function loadAllEnrolled_studentsAreEnrolled_expectedStudentsReturned() {
    $results = $this->getRepository()->loadAllEnrolled($this->semesterId);
    $this->assertTrue(count($results) == 3, 'Expected 3 results, got ' . count($results));
    foreach ($results as $student) {
      $this->assertTrue(in_array($student['student_id'], Array(1, 2)), 'Wrong id : ' . $student['student_id']);
    }
  }

  /**
   * @test
   */
  public function loadAll_studentAreRegistered_expectedStudentsReturned() {
    $results = $this->getRepository()->loadAll();
    $this->assertTrue(count($results) == 5, 'Expected 3 results, got ' . count($results));
  }

  /**
   * @test
   */
  public function loadAllNotEnrolled_studentIsNotEnrolled_expectedStudentReturned() {
    $results = $this->getRepository()->loadNotEnrolledInCourses(Array(1));
    $this->assertTrue(count($results) == 1, 'Expected 1 result, got ' . count($results));
    $lastname = $results[0]['lastname'];
    $this->assertEquals('Lastname 3', $lastname, 'Wrong lastname: ' . $lastname);
  }

  /**
   * @test
   */
  public function loadAllEnrolledInCourse_studentsAreEnrolled_expectedStudentsReturned() {
    $results = $this->getRepository()->loadAllEnrolledInCourse(1);
    $this->assertTrue(count($results) == 2, 'Expected 2 results, got ' . count($results));
    foreach ($results as $student) {
      $lastname = $student['lastname'];
      $this->assertTrue(in_array($lastname, Array('Lastname 1', 'Lastname 2')), 'Wrong lastname: ' . $lastname);
    }
  }

  /**
   * @test
   */
  public function loadAllEnrolledInCourses_studentsAreEnrolled_expectedStudentsReturned() {
    $results = $this->getRepository()->loadAllEnrolledInCourses(Array(1));
    $this->assertTrue(count($results) == 2, 'Expected 2 results, got ' . count($results));
    foreach ($results as $student) {
      $lastname = $student['lastname'];
      $this->assertTrue(in_array($lastname, Array('Lastname 1', 'Lastname 2')), 'Wrong lastname: ' . $lastname);
    }
  }

  /**
   * @test
   */
  public function loadAllEnrolledInCourseEntities_studentsAreEnrolled_expectedStudentsReturned() {
    $results = $this->getRepository()->loadAllEnrolledInCourseEntities(1);
    $this->assertTrue(count($results) == 2, 'Expected 2 results, got ' . count($results));
    foreach ($results as $student) {
      $this->assertTrue($student instanceof \Virgule\Bundle\MainBundle\Entity\Student, '$student is not an instance of Student entity');
      $lastname = $student->getLastname();
      $this->assertTrue(in_array($lastname, Array('Lastname 1', 'Lastname 2')), 'Wrong lastname: ' . $lastname);
    }
  }

  /**
   * @test
   */
  public function getNumberOfStudentRegisteredAfterDates_oneDateProvidedAndOneStudentRegisteredAfter_numberOneReturned() {
    $pDate1 = new \DateTime('now');
    $result = $this->getRepository()->getNumberOfStudentRegisteredAfterDates(Array('pDate1' => $pDate1));
    $this->assertEquals(1, $result['nb_students'], 'Expected 1, got ' . $result['nb_students']);
  }

  /**
   * @test
   */
  public function getNumberOfStudentRegisteredAfterDates_twoDatesProvidedAndThreeStudentsRegisteredAfter_numberThreeReturned() {
    $pDate1 = new \DateTime('01-01-1969');
    $pDate2 = new \DateTime('now');
    $result = $this->getRepository()->getNumberOfStudentRegisteredAfterDates(Array('pDate1' => $pDate1, 'pDate2' => $pDate2));
    $this->assertEquals(3, $result['nb_students'], 'Expected 3, got ' . $result['nb_students']);
  }

  /**
   * @test
   */
  public function getNumberOfStudentRegisteredAfterDates_oneDateProvidedAndNoStudentRegisteredAfter_numberZeroReturned() {
    $pDate1 = new \DateTime('now');
    $pDate1->modify('+365 day');
    $result = $this->getRepository()->getNumberOfStudentRegisteredAfterDates(Array('pDate1' => $pDate1));
    $this->assertEquals(0, $result['nb_students'], 'Expected 0, got ' . $result['nb_students']);
  }

  /**
   * @test
   */
  public function search_partialNameProvided_studentWithCorrespondingFirstNameFound() {
    $results = $this->getRepository()->search('irstname 2');
    $this->assertEquals(1, count($results), 'Expected 1, got ' . count($results));
    $this->assertEquals('Firstname 2', $results[0]['firstname'], 'Wrong firstname');
  }

  /**
   * @test
   */
  public function search_partialNameProvided_studentWithCorrespondingLastNameFound() {
    $results = $this->getRepository()->search('astname 2');
    $this->assertEquals(1, count($results), 'Expected 1, got ' . count($results));
    $this->assertEquals('Lastname 2', $results[0]['lastname'], 'Wrong lastname');
  }

  /**
   * @test
   */
  public function getStudentsInformation_twoStudentsInThreeCourses_twoStudentsReturnedWithCorrectInformation() {
    $results = $this->getRepository()->getStudentsInformation(1);
    $expectedNbResults = 2;
    $this->assertEquals($expectedNbResults, count($results), 'Expected ' . $expectedNbResults . ', got ' . count($results));

    foreach ($results as $student) {
      $studentId = $student['student_id'];
      $this->assertEquals(new \DateTime('0' . $studentId . '-01-1970'), $student['student_birthDate'], 'Birthdate is wrong');
      $this->assertEquals('M', $student['student_gender'], 'Gender is wrong');
      $this->assertEquals('FR', $student['nativeCountry'], 'Country is wrong');
    }
  }

}

?>
