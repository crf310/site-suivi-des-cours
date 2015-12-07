<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;
use Virgule\Bundle\MainBundle\Entity\Student;

class StudentControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_studenttype';
  private $OPTION_MALE_GENDER = 'M';
  private $OPTION_FEMALE_GENDER = 'F';

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

  /**
   * @test
   */
  public function newAction_allMandatoryInformationProvided_newStudentIsRegistered() {
    $firstName = 'Nouvel';
    $lastName = 'Apprenant';
    $gender = 'M';
    $registrationDate = '10/01/1985';
    $welcomedByTeacher = '2'; // User Active 1
    $suggestedClassLevel = '2'; // Class level 2';
    $nativeCountry = 'ID'; // Indonésie';

    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/student/new');

    $this->fillAndSubmitCreationForm($firstName, $lastName, $gender, $nativeCountry, $registrationDate, $welcomedByTeacher, $suggestedClassLevel);

    $this->assertPageContainsTitle($firstName . ' ' . strtoupper($lastName));
    $this->assertStudentProfileContainsInfo('Masculin');
    $this->assertStudentProfileContainsInfo($registrationDate);
    $this->assertStudentProfileContainsInfo('User Active 1');
    $this->assertStudentProfileContainsInfo('Class level 2');
    $this->assertStudentProfileContainsInfo('Indonésie');

    $this->logout();
  }

  /**
   * @test
   */
  public function newAction_registrationDateIsNotProvided_errorIsThrownAndStudentIsNotRegistered() {
    $firstName = 'Nouvel';
    $lastName = 'Apprenant';
    $gender = 'M';
    $registrationDate = '';
    $welcomedByTeacher = '2'; // User Active 1
    $suggestedClassLevel = '2'; // Class level 2';
    $nativeCountry = 'ID'; // Indonésie';

    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/student/new');

    $this->assertPageContainsTitle('Enregistrer un nouvel apprenant');

    $this->fillAndSubmitCreationForm($firstName, $lastName, $gender, $nativeCountry, $registrationDate, $welcomedByTeacher, $suggestedClassLevel, false);

    $this->assertPageContainsTitle('Enregistrer un nouvel apprenant');
    $this->assertFormFieldContainsError('Merci de saisir une date d\'\'accueil');

    $this->logout();
  }

  /**
   * @test
   */
  public function deleteAction_studentExists_studentIsDeleted() {
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

    $this->assertPageContainsTitle('Bob LA CHANCE');

    $this->submitFormById('delete-student-form');

    $this->assertPageContainsTitle('Tous les apprenants inscrits à un cours de cette session');
    $this->goToRoute('/student/' . $newStudentId . '/show', 404);

    $this->logout();
  }

  private function fillAndSubmitCreationForm($firstName, $lastName, $gender, $nativeCountry, $registrationDate, $welcomedByTeacher, $suggestedClassLevel, $followRedirect = true, $buttonLabel = "Enregistrer l'apprenant") {
    // Fill in the form and submit it
    $form = $this->crawler->selectButton($buttonLabel)->form(array(
        $this->FIELD_PREFIX . '[lastname]' => $lastName,
        $this->FIELD_PREFIX . '[firstname]' => $firstName,
        $this->FIELD_PREFIX . '[registrationDate]' => $registrationDate
    ));

    $form[$this->FIELD_PREFIX . '[gender]']->select($gender);
    $form[$this->FIELD_PREFIX . '[welcomedByTeacher]']->select($welcomedByTeacher);
    $form[$this->FIELD_PREFIX . '[suggestedClassLevel][0][classLevel]']->select($suggestedClassLevel);
    $form[$this->FIELD_PREFIX . '[nativeCountry]']->select($nativeCountry);

    $this->client->submit($form);

    if ($followRedirect) {
      $this->crawler = $this->client->followRedirect();
    } else {
      $this->crawler = $this->client->reload();
    }
  }

  private function assertStudentProfileContainsInfo($info) {
    $this->assertTrue($this->crawler->filter("div.controls:contains('" . $info . "')")->count() >= 1, "Info not found in profile: " . $info);
  }

}
