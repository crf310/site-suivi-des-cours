<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class ClassLevelControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_classleveltype';

  /**
   * @test
   */
  public function newAction_userCallsTheForm_newClassLevelFormIsDisplayed() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/classlevel/new');

    $this->assertPageContainsTitle('Ajouter un niveau de cours', 'h5');

    $this->logout();
  }

}
