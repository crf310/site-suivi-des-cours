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

  /**
   * @test
   */
  public function newAction_allMandatoryInformationProvided_classSessionIsSavedWithCorrectInformation() {
    $date = new \DateTime('1985-05-10T06:00:00');
    $sDate = $date->format("d/m/Y");
    $summary = "blablabla";

    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('classsession/add/course/1');

    $this->assertPageContainsTitle('Ajouter un compte-rendu');
    $this->fillAndSubmitModificationForm($sDate, $summary);

    $this->assertTrue($this->crawler->filter("div.alert-flash:contains('Votre compte-rendu pour le " . $sDate . " a bien été enregistré')")->count() == 1, "la date n'est pas affichée");

    $this->assertPageContainsTitle('Compte-rendu de cours');
    $this->assertTrue($this->crawler->filter("div.controls:contains('" . $sDate . "')")->count() == 1, "la date n'est pas affichée");
    $this->assertTrue($this->crawler->filter("div.text-block:contains('" . $summary . "')")->count() == 1, "le résumé n'est pas correctement affiché");

    $this->logout();
  }

    private function fillAndSubmitModificationForm($sessionDate, $sessionSummary, $followRedirect = true, $buttonLabel = 'Enregistrer le compte-rendu') {
    // Fill in the form and submit it
    $form = $this->crawler->selectButton($buttonLabel)->form(array(
        $this->FIELD_PREFIX . '[sessionDate]' => $sessionDate,
        $this->FIELD_PREFIX . '[summary]' => $sessionSummary
    ));

    $this->client->submit($form);

    if ($followRedirect) {
      $this->crawler = $this->client->followRedirect();
    } else {
      $this->crawler = $this->client->reload();
    }
  }
}
