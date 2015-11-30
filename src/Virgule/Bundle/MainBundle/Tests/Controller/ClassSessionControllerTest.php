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
  public function newAction_reportDateIsEmpty_errorIsThrownAndClassSessionIsNotSaved() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('classsession/add/course/1');
    $this->fillAndSubmitModificationForm('', 'blablabla', false);
    $this->assertNotEquals(500, $this->client->getResponse()->getStatusCode());
    $this->assertFormFieldContainsError('Merci de saisir une date pour ce compte rendu');

    $this->logout();
  }

  /**
   * @test
   */
  public function newAction_summaryIsEmpty_errorIsThrownAndClassSessionIsNotSaved() {
    $date = new \DateTime('now');
    $sDate = $date->format("d/m/Y");

    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('classsession/add/course/2');
    $this->fillAndSubmitModificationForm($sDate, '', false);

    $this->assertNotEquals(500, $this->client->getResponse()->getStatusCode());
    $this->assertFormFieldContainsError('Merci de saisir un résumé du cours');

    $this->logout();
  }

  /**
   * @test
   */
  public function newAction_reportDateAndsummaryAreEmpty_errorAreThrownAndClassSessionIsNotSaved() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('classsession/add/course/1');
    $this->fillAndSubmitModificationForm('', '', false);

    $this->assertNotEquals(500, $this->client->getResponse()->getStatusCode());
    $this->assertFormFieldContainsError('Merci de saisir une date pour ce compte rendu');
    $this->assertFormFieldContainsError('Merci de saisir un résumé du cours');

    $this->logout();
  }

  /**
   * @test
   */
  public function newAction_allMandatoryInformationProvided_classSessionIsSavedWithCorrectInformation() {
    $date = new \DateTime('now');
    $sDate = $date->format("d/m/Y");
    $summary = "blablabla";

    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('classsession/add/course/1');

    $this->assertPageContainsTitle('Ajouter un compte-rendu');
    $this->fillAndSubmitModificationForm($sDate, $summary);

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
