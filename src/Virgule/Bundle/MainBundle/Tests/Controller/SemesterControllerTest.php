<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class SemesterControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_semestertype';

  private function fillAndSubmitCreationForm($startDate, $endDate, $followRedirect = true, $buttonLabel = "Enregistrer le semestre") {
    // Fill in the form and submit it
    $form = $this->crawler->selectButton($buttonLabel)->form(array(
        $this->FIELD_PREFIX . '[startDate]' => $startDate->format('d/m/Y'),
        $this->FIELD_PREFIX . '[endDate]' => $endDate->format('d/m/Y')
    ));
    
    $this->client->submit($form);

    if ($followRedirect) {
      $this->crawler = $this->client->followRedirect();
    } else {
      $this->crawler = $this->client->reload();
    }
  }

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
  public function newAction_newSemesteStartsBeforePreviousEnds_semesterIsNotCreatedAndErrorIsShown() {
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/semester/new');

    $this->assertPageContainsTitle('Enregistrer un nouveau semestre');

    $startDate = new \DateTime('now');
    $startDate->modify('-10 day');
    
    $endDate = new \DateTime('now');
    $endDate->modify('+10 day');
    
    $this->fillAndSubmitCreationForm($startDate, $endDate, false);

    $this->assertFormContainsError('Un semestre n\'\'est pas terminé au ' . $startDate->format('d/m/Y'));
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
