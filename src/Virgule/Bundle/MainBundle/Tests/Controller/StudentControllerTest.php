<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class StudentControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_studenttype';

  /**
   * @test
   */
  public function showMyStudents_connectedUserHasNoStudents_studentsTableIsEmpty() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/student/mystudents');

    $this->assertPageContainsTitle('Mes apprenants');
    $this->assertTrue($this->crawler->filter("span.label:contains('0')")->count() == 1, 'Students table should be empty');

    $this->logout();
  }

  /**
   * @test
   */
  public function newAction_userCallsTheForm_newStudentFormIsDisplayed() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/student/new');

    $this->assertPageContainsTitle('Enregistrer un nouvel apprenant');

    $this->logout();
  }

}
