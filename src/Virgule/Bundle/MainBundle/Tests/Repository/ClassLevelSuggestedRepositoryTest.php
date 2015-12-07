<?php

namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

class ClassLevelSuggestedRepositoryTest extends AbstractRepositoryTest {

  private function getRepository() {
    return self::$_em->getRepository('VirguleMainBundle:ClassLevelSuggested');
  }

  /**
   * @test
   */
  public function getClassLevelsHistoryPerStudent_studentHasThreeRecords_correctClassLevelsReturned() {
    $classLevels = $this->getRepository()->getClassLevelsHistoryPerStudent(3);

    $this->assertEquals(3, count($classLevels));

    $classLevel = $classLevels[0];
    $this->assertEquals('Class level 1', $classLevel['classLevelLabel'], 'Class level label is wrong [0]');
    $this->assertEquals('User Active 1', $classLevel['teacher_firstName'] . ' ' . $classLevel['teacher_lastName'], 'Changer name is wrong [0]');
    $expectedDate = new \DateTime('08-01-2014');
    $this->assertEquals($expectedDate->format('d/m/Y'), $classLevel['dateOfChange']->format('d/m/Y'), 'Date of change is wrong [0]');

    $classLevel = $classLevels[1];
    $this->assertEquals('Class level 3', $classLevel['classLevelLabel'], 'Class level label is wrong [1]');
    $this->assertEquals('User Active 3', $classLevel['teacher_firstName'] . ' ' . $classLevel['teacher_lastName'], 'Changer name is wrong [1]');
    $expectedDate = new \DateTime('10-01-1985');
    $this->assertEquals($expectedDate->format('d/m/Y'), $classLevel['dateOfChange']->format('d/m/Y'), 'Date of change is wrong [1]');

    $classLevel = $classLevels[2];
    $this->assertEquals('Class level 2', $classLevel['classLevelLabel'], 'Class level label is wrong [2]');
    $this->assertEquals('User Active 1', $classLevel['teacher_firstName'] . ' ' . $classLevel['teacher_lastName'], 'Changer name is wrong [2]');
    $expectedDate = new \DateTime('01-5-1982');
    $this->assertEquals($expectedDate->format('d/m/Y'), $classLevel['dateOfChange']->format('d/m/Y'), 'Date of change is wrong [2]');
  }

  /**
   * @test
   */
  public function getCurrentClassLevelSuggested_studentHasThreeRecords_latestOneIsReturned() {
    $currentClassLevel = $this->getRepository()->getCurrentClassLevelSuggested(3);
    $this->assertNotNull($currentClassLevel);
    $this->assertEquals('Class level 1', $currentClassLevel->getClassLevel()->getLabel(), 'Current class level label is wrong');
    $this->assertEquals('User Active 1', $currentClassLevel->getChanger()->getFullName(), 'Changer name is wrong');

    $expectedDate = new \DateTime('08-01-2014');
    $this->assertEquals($expectedDate->format('d/m/Y'), $currentClassLevel->getDateOfChange()->format('d/m/Y'), 'Date of change is wrong');
  }

}

?>
