<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class TeacherControllerTest extends AbstractControllerTest {
    
    private $FIELD_PREFIX = 'virgule_bundle_mainbundle_teachertype';

    public function testUserCreationSuccess() {
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
        $passwordFirst = "password";
        $passwordSecond = $passwordFirst;
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond);
        
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 0);
        
        $this->assertEquals(1, $this->crawler->filter("td:contains('" . $firstName . " " . $lastName . "')")->count());
        $this->assertEquals(1, $this->crawler->filter("td:contains('" . $phoneNumberFormatted ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("td:contains('" . $cellPhoneNumberFormatted ."')")->count());
        
        $crawlerTeacher = $this->crawler->filter("td:contains('" . $firstName . " " . $lastName . "')")->siblings();
        $this->crawler = $this->client->click($crawlerTeacher->selectLink('Détails')->link());
        
        $this->assertTrue($this->crawler->filter("html:contains('Fiche formateur')")->count() == 1);
        $this->assertTrue($this->crawler->filter("html:contains('Liste des formateurs actifs')")->count() == 0);
        
        $this->assertEquals(1, $this->crawler->filter("div.widget-title:contains('" . $firstName . " " . $lastName . "')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $phoneNumberFormatted ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $cellPhoneNumberFormatted ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $emailAddress ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . date("d/m/Y") ."')")->count());
                
        $this->assertEquals(1, $this->crawler->filter("div.widget-content:contains('Aucun apprenant trouvé')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.widget-content:contains(' Aucun cours dirigé pour le moment')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.widget-content:contains('Aucun compte-rendu enregistré pour le moment')")->count());
    }
    
     public function testUserCreationSameUsername() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
        
        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();
        
        $lastName =  "Doe";
        $firstName = "John";        
        $phoneNumber = "0102030405";
        $cellPhoneNumber = "0504030201";
        $emailAddress = "john.doe@example.com";
        $userName = "jdoe" . time();
        $passwordFirst = "password";
        $passwordSecond = $passwordFirst;
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond);
        
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 0);
        
        $this->goToUserCreationForm();
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, false);
        
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1);        
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('utilisateur est déjà pris')")->count() >= 1);
    }
    
    public function testUserCreationNoLastName() {
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
        $passwordFirst = "password";
        $passwordSecond = $passwordFirst;
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, false);
                
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1);        
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('Merci de saisir un nom de famille')")->count() >= 1);
    }
    
    public function testUserCreationNoLastFirstName() {
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
        $passwordFirst = "password";
        $passwordSecond = $passwordFirst;
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, false);
                
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1);        
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('Merci de saisir un prénom')")->count() >= 1);
    }
    
    /*
    public function testUserCreationInvalidEmailAddress() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
        
        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();
        
        $lastName =  "Doe";
        $firstName = "";        
        $phoneNumber = "0908078060504030201";
        $cellPhoneNumber = "01";
        $emailAddress = "john.doe example. com";
        $userName = "jdoe" . time();
        $passwordFirst = "password";
        $passwordSecond = $passwordFirst;
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, false);
                
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1);        
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('Cette adresse est invalide')")->count() >= 1);
    }
     * */
    
    public function testUserCreationUnmatchingPasswords() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
        
        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();
        
        $lastName =  "Doe";
        $firstName = "John";        
        $phoneNumber = "0908078060504030201";
        $cellPhoneNumber = "01";
        $emailAddress = "john.doe example. com";
        $userName = "jdoe" . time();
        $passwordFirst = "password";
        $passwordSecond = "password_different";
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, false);
                
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1);        
        $this->assertTrue($this->crawler->filter("span.help-inline:contains('Les mots de passe ne correspondent pas')")->count() >= 1);
    }
    
    public function testUserCreationPhoneNumbersTooShort() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
        
        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();
        
        $lastName =  "Doe";
        $firstName = "John";        
        $phoneNumber = "01";
        $cellPhoneNumber = "01";
        $emailAddress = "john.doe example. com";
        $userName = "jdoe" . time();
        $passwordFirst = "password";
        $passwordSecond = "password";
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, false);
                
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1);        
        $this->assertEquals(2, $this->crawler->filter("span.help-inline:contains('Le numéro de téléphone doit comporter 10 chiffres, et seulement 10')")->count());
    }

    public function testUserCreationPhoneNumbersTooLong() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
        
        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $this->goToUserCreationForm();
        
        $lastName =  "Doe";
        $firstName = "John";        
        $phoneNumber = "010203040506070809";
        $cellPhoneNumber = "010203040506070809";
        $emailAddress = "john.doe example. com";
        $userName = "jdoe" . time();
        $passwordFirst = "password";
        $passwordSecond = "password";
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, false);
                
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 1); 
        $this->assertEquals(2, $this->crawler->filter("span.help-inline:contains('Le numéro de téléphone doit comporter 10 chiffres, et seulement 10')")->count());
    }

    public function testUpdateProfile() {
        // Create a new client to browse the application
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
        
        $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        
        $this->crawler = $this->client->request('GET', '/welcome');
        $this->assertEquals(1, $this->crawler->filter("html:contains('Accueil')")->count());
        
        $crawlerLinkProfile = $this->crawler->filter("span:contains('" . $this->ADMIN_FIRSTNAME . " " . $this->ADMIN_LASTNAME . "')")->parents();
        $this->crawler = $this->client->click($crawlerLinkProfile->link());
        
        $this->assertEquals(1, $this->crawler->filter("h5:contains('" . $this->ADMIN_FIRSTNAME . " " . $this->ADMIN_LASTNAME . "')")->count());
        $this->crawler = $this->client->click($this->crawler->selectLink('Modifier le profil')->link());        
                
        $this->assertEquals(1, $this->crawler->filter("html:contains('Modifier la fiche de " . $this->ADMIN_FIRSTNAME . " " . $this->ADMIN_LASTNAME . "')")->count());
        
        $lastName =  $this->ADMIN_LASTNAME . 'edited';
        $firstName = $this->ADMIN_FIRSTNAME . 'edited';       
        $phoneNumber = "0909090909";
        $cellPhoneNumber = "0808080808";        
        $phoneNumberFormatted = "09 09 09 09 09";
        $cellPhoneNumberFormatted = "08 08 08 08 08";
        $emailAddress = $this->ADMIN_LASTNAME . '.' . $this->ADMIN_FIRSTNAME . '.new@example.com';
        $userName = "new_username";
        $passwordFirst = "new_password";
        $passwordSecond = "new_password";
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, true, 'Enregistrer les modifications');  
        
        $this->assertEquals(1, $this->crawler->filter("div.widget-title:contains('" . $firstName . " " . $lastName . "')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $phoneNumberFormatted ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $cellPhoneNumberFormatted ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . $emailAddress ."')")->count());
        $this->assertEquals(1, $this->crawler->filter("div.controls:contains('" . date("d/m/Y") ."')")->count());
        
        $this->logout();
        $this->login($userName, $passwordFirst);
        
        $this->crawler = $this->client->request('GET', '/welcome');
        
        $this->assertEquals(1, $this->crawler->filter("span:contains('Accueil')")->count());
    }
    
    private function goToUserCreationForm() {
        // Create a new entry in the database
        $this->crawler = $this->client->request('GET', '/teacher/');
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());
        $this->crawler = $this->client->click($this->crawler->selectLink('Nouvel utilisateur')->link());
    }

    private function fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, $followRedirect = true, $buttonLabel= 'Créer le compte') {
        // Fill in the form and submit it
        $form = $this->crawler->selectButton($buttonLabel)->form(array(
            $this->FIELD_PREFIX . '[lastName]' => $lastName,
            $this->FIELD_PREFIX . '[firstName]' => $firstName,
            $this->FIELD_PREFIX . '[phoneNumber]' => $phoneNumber,
            $this->FIELD_PREFIX . '[cellphoneNumber]' => $cellPhoneNumber,
            $this->FIELD_PREFIX . '[email]' => $emailAddress,
            $this->FIELD_PREFIX . '[username]' => $userName,
            $this->FIELD_PREFIX . '[password][first]' => $passwordFirst,
            $this->FIELD_PREFIX . '[password][second]' => $passwordSecond,
                ));

        $this->client->submit($form);
        
        if ($followRedirect) {
            $this->crawler = $this->client->followRedirect();
        } else {
            $this->crawler = $this->client->reload();
        }
    }
}