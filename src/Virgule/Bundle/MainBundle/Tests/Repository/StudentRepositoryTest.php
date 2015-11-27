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
    public function loadAllEnrolled_studentsAreEnrolled_expectedStudentsReturned() {
        $results = $this->getRepository()->loadAllEnrolled($this->semesterId);
        $this->assertTrue(count($results) == 3, 'Expected 3 results, got ' . count($results));
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
}
?>
