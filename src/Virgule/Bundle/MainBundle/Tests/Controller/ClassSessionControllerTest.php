<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class ClassSessionControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_classsessiontype';

  /**
   * @test
   */
  public function newAction_userCallsTheForm_newClassSessionReportFormIsDisplayed() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('classsession/add/course/1');

    $this->assertPageContainsTitle('Ajouter un compte-rendu');

    $this->logout();
  }

}
