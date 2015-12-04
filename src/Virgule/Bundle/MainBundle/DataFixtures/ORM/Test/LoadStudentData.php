<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Student;
use Virgule\Bundle\MainBundle\Entity\ClassLevelSuggested;

/**
 * @author Guillaume Lucazeau
 */
class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $s1 = $this->createStudent(1);
    $s2 = $this->createStudent(2);

    // student in no class and registered after today
    $s3 = $this->createStudent(3);
    $studentRegistrationDate = new \DateTime('now');
    $studentRegistrationDate->modify('+5 day');
    $s3->setRegistrationDate($studentRegistrationDate);

    $manager->persist($s1);
    $manager->persist($s2);
    $manager->persist($s3);

    // class levels suggested for Student 3
    $classLevelSuggested1 = new ClassLevelSuggested();
    $classLevelSuggested1->setChanger($this->getReference('user-1'));
    $classLevelSuggested1->setClassLevel($this->getReference('classlevel-2'));
    $classLevelSuggested1->setDateOfChange(new \DateTime('01-05-1982'));
    $classLevelSuggested1->setStudent($s3);

    $classLevelSuggested2 = new ClassLevelSuggested();
    $classLevelSuggested2->setChanger($this->getReference('user-3'));
    $classLevelSuggested2->setClassLevel($this->getReference('classlevel-3'));
    $classLevelSuggested2->setDateOfChange(new \DateTime('10-01-1985'));
    $classLevelSuggested2->setStudent($s3);

    $classLevelSuggested3 = new ClassLevelSuggested();
    $classLevelSuggested3->setChanger($this->getReference('user-1'));
    $classLevelSuggested3->setClassLevel($this->getReference('classlevel-1'));
    $classLevelSuggested3->setDateOfChange(new \DateTime('08-01-2014'));
    $classLevelSuggested3->setStudent($s3);

    $manager->persist($classLevelSuggested1);
    $manager->persist($classLevelSuggested2);
    $manager->persist($classLevelSuggested3);

    $manager->flush();
  }

  private function createStudent($studentId) {
    $student = new Student();
    $student->setFirstname('Firstname ' . $studentId);
    $student->setLastname('Lastname ' . $studentId);
    $student->setRegistrationDate(new \DateTime('01-01-1970'));
    $student->setBirthDate(new \DateTime('0' . $studentId . '-01-1970'));
    $student->setGender('M');
    $student->setNativeCountry('FR');

    $this->addReference('student-' . $studentId, $student);

    return $student;
  }

  public function getOrder() {
    return 6;
  }

}

?>
