<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Student;

/**
 * @author Guillaume Lucazeau
 */
class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $s1 = $this->createStudent(1);
    $s2 = $this->createStudent(2);

    // student in no class
    $s3 = $this->createStudent(3);

    $manager->persist($s1);
    $manager->persist($s2);
    $manager->persist($s3);

    $manager->flush();
  }

  private function createStudent($studentId) {
    $student = new Student();
    $student->setFirstname('Firstname ' . $studentId);
    $student->setLastname('Lastname ' . $studentId);
    $student->setRegistrationDate(new \DateTime('01-01-1970'));

    $this->addReference('student-' . $studentId, $student);

    return $student;
  }

  public function getOrder() {
    return 6;
  }

}

?>
