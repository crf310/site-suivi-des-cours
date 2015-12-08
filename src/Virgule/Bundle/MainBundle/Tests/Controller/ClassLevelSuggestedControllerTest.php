<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;
use Virgule\Bundle\MainBundle\Entity\Student;
use Virgule\Bundle\MainBundle\Entity\ClassLevelSuggested;

class ClassLevelSuggestedControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_classlevelsuggestedtype';
  
  /**
   * @test
   */
  public function updateClassLevel_classLevelIsDifferentThanCurrent_classLevelIsUpdated() {
    $newStudent = new Student();
    $newStudent->setFirstname('Bob');
    $newStudent->setLastname('La Chance');
    $newStudent->setRegistrationDate(new \DateTime('now'));
    self::$_em->persist($newStudent);
    self::$_em->flush();
    $newStudentId = $newStudent->getId();
    $this->assertNotNull($newStudentId);

    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');
    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/student/' . $newStudentId . '/show');
    
    $this->changeClassLevel("1");

    // echo $this->client->getResponse()->getContent();die;// Just add this line
    $this->verifyClassLevelChangedMessage($this->ADMIN_USERNAME . ' ', 'Class level 1');
  }

  private function changeClassLevel($classLevelId, $followRedirect = true) {
    // Fill in the form and submit it
    $form = $this->getFormById('change-student-level-form');
    $form[$this->FIELD_PREFIX . '[classLevel]']->select($classLevelId);

    $this->client->submit($form);

    if ($followRedirect) {
      $this->crawler = $this->client->followRedirect();
    } else {
      $this->crawler = $this->client->reload();
    }
  }
  
  private function verifyClassLevelChangedMessage($changer, $classLevelLabel, $message = 'initialisé') {
    $expectedNodeValue = $changer. ' l\'a ' . $message . ' à ' . $classLevelLabel;
    $link = $this->crawler->filter("a.classlevelsuggested-entry")->first();
    
    foreach ($link as $domElement) {
      $this->assertTrue(strpos($domElement->nodeValue, $expectedNodeValue) !== false, 'Expected message "' . $expectedNodeValue . '" not found in: ' .$domElement->nodeValue);
    }
  }

}
