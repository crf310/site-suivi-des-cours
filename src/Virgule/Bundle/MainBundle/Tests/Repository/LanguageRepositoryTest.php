<?php

namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

class LanguageRepositoryTest extends AbstractRepositoryTest {

  private function getRepository() {
    return self::$_em->getRepository('VirguleMainBundle:Language');
  }

  /**
   * @test
   */
  public function getNumberOfLanguagesSpoken_twoLanguagesSpoken_twoLanguagesFoundWithCorrectNumberOfStudents() {
    $semesterId = 1;
    $results = $this->getRepository()->getNumberOfLanguagesSpoken($semesterId);
    $this->assertEquals(2, count($results), 'Expected 2 language, found ' . count($results));
    
    $this->assertEquals('Français', $results[0]['language_name']);
    $this->assertEquals(2, $results[0]['nb_students']);
    
    $this->assertEquals('Anglais', $results[1]['language_name']);
    $this->assertEquals(1, $results[1]['nb_students']);
  }

}

?>
