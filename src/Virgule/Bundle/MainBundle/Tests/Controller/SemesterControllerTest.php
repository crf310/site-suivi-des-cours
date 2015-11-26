<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class SemesterControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_semestertype';

  /**
   * @test
   */
  public function newAction_userCallsTheForm_newSemesterFormIsDisplayed() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/semester/new');

    $this->assertPageContainsTitle('Enregistrer un nouveau semestre');

    $this->logout();
  }

  /**
   * @test
   */
  public function indexAction_userDisplaysSemester_newOpenHouseFormIsDisplayed() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/semester/');

    $this->assertPageContainsTitle('Ajouter une journée d\'\'accueil', 'h5');

    $this->logout();
  }

}
