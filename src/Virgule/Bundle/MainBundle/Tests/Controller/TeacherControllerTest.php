<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class TeacherControllerTest extends AbstractControllerTest {

    private $FIELD_PREFIX = 'virgule_bundle_mainbundle_teachertype';

    /**
     * @test
     */
    public function createUser_allInformationOK_userIsSuccessfullyCreated() {
    // Create a new client to browse the application
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();

        $lastName =  "Lachance" . time();
        $firstName = "Bob" . time();
        $phoneNumber = "2026770549";
        $cellPhoneNumber = "0620518103";
        $phoneNumberFormatted = "20 26 77 05 49";
        $cellPhoneNumberFormatted = "06 20 51 81 03";
        $emailAddress = "bob.lachance." . time() . "@example.com";
        $userName = "bob" . time();

        $this->fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName);

        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 0, "Crawler should not have stayed on user creation form");
        $this->assertTrue($this->crawler->filter("td:contains('" . $firstName . " " . $lastName . "')")->count() == 1, "User page should display first and last names (" . $firstName . " " . $lastName . ")");
        $this->assertTrue($this->crawler->filter("td:contains('" . $phoneNumberFormatted ."')")->count() == 1, "User page should display the phone number");
        $this->assertTrue($this->crawler->filter("td:contains('" . $cellPhoneNumberFormatted ."')")->count() == 1, "User page should display the mobile phone");

        $crawlerTeacher = $this->crawler->filter("td:contains('" . $firstName . " " . $lastName . "')")->siblings();
        $this->crawler = $this->client->click($crawlerTeacher->selectLink('Détails')->link());

        $this->assertTrue($this->crawler->filter("html:contains('Fiche formateur')")->count() == 1);
        $this->assertTrue($this->crawler->filter("html:contains('Liste des formateurs actifs')")->count() == 0, "User list should contain the created user");

        $this->assertEquals(1, $this->crawler->filter("div.widget-title:contains('" . $firstName . " " . $lastName . "')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $phoneNumberFormatted ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $cellPhoneNumberFormatted ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $emailAddress ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . date("d/m/Y") ."')")->count());

        $this->assertEquals(1, $this->crawler->filter("div.widget-content:contains('Aucun apprenant trouvé')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.widget-content:contains(' Aucun cours dirigé pour le moment')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.widget-content:contains('Aucun compte-rendu enregistré pour le moment')")->count());

        $this->logout();
    }

    /**
     * @test
     */
     public function createUser_userNameAlreadyExists_warningMessageAndUserIsNotCreated() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');

        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();

        $lastName =  "Doe";
        $firstName = "John";
        $phoneNumber = "0102030405";
        $cellPhoneNumber = "0504030201";
        $userName = "jdoe-same-username";

        $this->fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, "john.doe.1@example.com", $userName);

        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 0, "Crawler stayed on user creation form");

        $this->goToUserCreationForm();
        $this->fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, "john.doe.2@example.com", $userName, false);

        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1, "Crawler should have stayed on user creation form");
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('utilisateur est déjà pris')")->count() >= 1, "Warning message should be displayed");

        $this->logout();
    }

    /**
     * @test
     */
    public function createUser_noLastNameProvided_warningMessageAndUserIsNotCreated() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');

        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

        $this->goToUserCreationForm();

        $lastName =  "";
        $firstName = "John";
        $phoneNumber = "0102030405";
        $cellPhoneNumber = "0504030201";
        $emailAddress = "john.doe@example.com";
        $userName = "jdoe" . time();
        $this->fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, false);

        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1, "Crawler should have stayed on user creation form");
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('Merci de saisir un nom de famille')")->count() >= 1, "Warning message should be displayed");

        $this->logout();
    }

    /**
     * @test
     */
    public function createUser_noFirstNameProvided_warningMessageAndUserIsNotCreated() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');

        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();

        $lastName =  "Doe";
        $firstName = "";
        $phoneNumber = "0102030405";
        $cellPhoneNumber = "0504030201";
        $emailAddress = "john.doe@example.com";
        $userName = "jdoe" . time();

        $this->fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, false);

        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1, "Crawler should have stayed on user creation form");
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('Merci de saisir un prénom')")->count() >= 1, "Warning message should be displayed");

        $this->logout();
    }

    /**
     * @test
     */
    public function createUser_emailAddressIsInvalid_warningMessageAndUserIsNotCreated() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');

        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();

        $lastName =  "Doe";
        $firstName = "John";
        $phoneNumber = "0102030405";
        $cellPhoneNumber = "0504030201";
        $emailAddress = "jdoe_example_com_" . time();
        $userName = "jdoe-wrong-email" . time();

        $this->fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, false);
        
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1, "Crawler should have stayed on user creation form");
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('adresse e-mail est invalide')")->count() == 1, "Warning message should be displayed");

    }

    /**
     * @test
     */
    public function createUser_phoneNumberIsTooShort_warningMessageAndUserIsNotCreated() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');

        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();

        $lastName =  "Doe";
        $firstName = "John";
        $phoneNumber = "01";
        $cellPhoneNumber = "01";
        $emailAddress = "john.doe@example.com";
        $userName = "jdoe" . time();

        $this->fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, false);
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1, "Crawler should have stayed on user creation form");
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('Le numéro de téléphone doit comporter 10 chiffres, et seulement 10')")->count() == 2, "Warning message should be displayed");

        $this->logout();
    }

    /**
     * @test
     */
    public function createUser_phoneNumberIsTooLong_warningMessageAndUserIsNotCreated() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');

        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();

        $lastName =  "Doe";
        $firstName = "John";
        $phoneNumber = "010203040506070809";
        $cellPhoneNumber = "010203040506070809";
        $emailAddress = "john.doe@example.com";
        $userName = "jdoe" . time();

        $this->fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, false);

        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1, "Crawler should have stayed on user creation form");
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('Le numéro de téléphone doit comporter 10 chiffres, et seulement 10')")->count() == 2, "Warning message should be displayed");

        $this->logout();
    }

    /**
     * @test
     */
    public function updateProfile_allInformationChangedAndValid_profileIsCorrectlyUpdated() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');

        $this->login($this->USER_USERNAME, $this->USER_PASSWORD);

        $this->goToDashboard();
        $this->assertEquals(1, $this->crawler->filter("html:contains('Accueil')")->count());

        $crawlerLinkProfile = $this->crawler->filter('#go-to-profile');
        $this->crawler = $this->client->click($crawlerLinkProfile->link());

        $this->assertTrue($this->crawler->filter("h5:contains('" . $this->USER_FIRSTNAME . " " . $this->USER_LASTNAME . "')")->count() == 1, "le nom de l'utilisateur n'a pas été trouvé dans le titre");
        $this->crawler = $this->client->click($this->crawler->selectLink('Modifier le profil')->link());

        $this->assertTrue($this->crawler->filter("html:contains('Modifier la fiche de " . $this->USER_FIRSTNAME . " " . $this->USER_LASTNAME . "')")->count() == 1, "le lien de modification de la fiche n'a pas été trouvé");

        $lastName =  $this->USER_LASTNAME . 'edited';
        $firstName = $this->USER_FIRSTNAME . 'edited';
        $phoneNumber = "0909090909";
        $cellPhoneNumber = "0808080808";
        $phoneNumberFormatted = "09 09 09 09 09";
        $cellPhoneNumberFormatted = "08 08 08 08 08";
        $emailAddress = 'email-new@example.com';

        $this->fillAndSubmitModificationForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, true, 'Enregistrer les modifications');

        $this->assertTrue($this->crawler->filter("h5:contains('" . $firstName . " " . $lastName . "')")->count() == 1, "le nom ou le prénom ne sont pas affichés");
        $this->assertTrue($this->crawler->filter("div.controls:contains('" . $phoneNumberFormatted ."')")->count() == 1, "le n° de tél formaté n'est pas affiché");
        $this->assertTrue($this->crawler->filter("div.controls:contains('" . $cellPhoneNumberFormatted ."')")->count() == 1, "le n° de mobile formaté n'est pas affiché");
        $this->assertTrue($this->crawler->filter("div.controls:contains('" . $emailAddress ."')")->count() == 1, "l'adresse email n'est pas affichée");
        $this->assertTrue($this->crawler->filter("div.controls:contains('" . date("d/m/Y") ."')")->count() == 1, "la date n'est pas affichée");

        $this->logout();
    }

    private function goToUserCreationForm() {
        // Create a new entry in the database
        $this->crawler = $this->client->request('GET', '/teacher/');
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());
        $this->crawler = $this->client->click($this->crawler->selectLink('Nouvel utilisateur')->link());
    }

    private function goToChangePasswordForm() {
        // Create a new entry in the database
        $this->crawler = $this->client->request('GET', '/profile/change-password');
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());
    }

    private function fillAndSubmitChangePasswordForm($currentPassword, $newPassword, $followRedirect = true) {
        // Fill in the form and submit it
        $form = $this->crawler->selectButton('Mettre à jour le mot de passe')->form(array(
            'fos_user_change_password_form[current_password]' => $currentPassword,
            'fos_user_change_password_form[plainPassword][first]' => $newPassword,
            'fos_user_change_password_form[plainPassword][second]' => $newPassword,
                ));

        $this->client->submit($form);
        if ($followRedirect) {
            $this->crawler = $this->client->followRedirect();
        } else {
            $this->crawler = $this->client->reload();
        }
    }

    private function fillAndSubmitCreationForm($firstName, $lastName, $phoneNumber, $cellphoneNumber, $emailAddress, $username,  $followRedirect = true, $buttonLabel= 'Créer le compte') {
        // Fill in the form and submit it
        $form = $this->crawler->selectButton($buttonLabel)->form(array(
            $this->FIELD_PREFIX . '[lastName]' => $lastName,
            $this->FIELD_PREFIX . '[firstName]' => $firstName,
            $this->FIELD_PREFIX . '[phoneNumber]' => $phoneNumber,
            $this->FIELD_PREFIX . '[cellphoneNumber]' => $cellphoneNumber,
            $this->FIELD_PREFIX . '[email]' => $emailAddress,
            $this->FIELD_PREFIX . '[username]' => $username
        ));

        $this->client->submit($form);
        
        if ($followRedirect) {
            $this->crawler = $this->client->followRedirect();
        } else {
            $this->crawler = $this->client->reload();
        }
    }

    private function fillAndSubmitModificationForm($firstName, $lastName, $phoneNumber, $cellphoneNumber, $emailAddress,  $followRedirect = true, $buttonLabel= 'Créer le compte') {
        // Fill in the form and submit it
        $form = $this->crawler->selectButton($buttonLabel)->form(array(
            $this->FIELD_PREFIX . '[lastName]' => $lastName,
            $this->FIELD_PREFIX . '[firstName]' => $firstName,
            $this->FIELD_PREFIX . '[phoneNumber]' => $phoneNumber,
            $this->FIELD_PREFIX . '[cellphoneNumber]' => $cellphoneNumber,
            $this->FIELD_PREFIX . '[email]' => $emailAddress
        ));

        $this->client->submit($form);

        if ($followRedirect) {
            $this->crawler = $this->client->followRedirect();
        } else {
            $this->crawler = $this->client->reload();
        }
    }
}

