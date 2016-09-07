<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class OrganizationBranchControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_organizationbranchtype';

  /**
   * @test
   */
  public function newAction_userCallsTheForm_newOrganizationBranchFormIsDisplayed() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/organizationbranch/new');

    $this->assertPageContainsTitle('Ajouter une délégation');

    $this->logout();
  }

}
