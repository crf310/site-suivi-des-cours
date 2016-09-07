<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class CourseControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_studenttype';

  /**
   * @test
   */
  public function newAction_userCallsTheForm_newCourseFormIsDisplayed() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/course/new');

    $this->assertPageContainsTitle('Enregistrer un nouveau cours');

    $this->logout();
  }

}
