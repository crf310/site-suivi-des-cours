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
        
        $lastName =  "Doe" . time();
        $firstName = "John" . time();        
        $phoneNumber = "0102030405";
        $cellPhoneNumber = "0504030201";
        $emailAddress = "john.doe." . time() . "@example.com";
        $userName = "jdoe" . time();
        $passwordFirst = "password";
        $passwordSecond = $passwordFirst;
        $this->fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond);
        
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 0);
        
        $this->assertTrue($this->crawler->filter("td:contains('" . $firstName . " " . $lastName . "')")->count() > 0);
        $this->assertTrue($this->crawler->filter("td:contains('01 02 03 04 05')")->count() > 0);
        $this->assertTrue($this->crawler->filter("td:contains('05 04 03 02 01')")->count() > 0);
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
        echo $this->client->getResponse(); die;
        $this->assertEquals(2, $this->crawler->filter("span.help-inline:contains('Le numéro de téléphone doit comporter 10 chiffres, et seulement 10')")->count());
    }
    /*
    public function testCompleteScenario() {
        // Create a new client to browse the application
        $client = static::createClient();

        $crawler = $this->login($client, $crawler, 'prof1', 'password');




        // Check data in the show view
        $this->assertTrue($crawler->filter('td:contains("Test")')->count() > 0);

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'teacher[field_name]' => 'Foo',
                // ... other fields to fill
                ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertTrue($crawler->filter('[value="Foo"]')->count() > 0);

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
     */

    private function goToUserCreationForm() {
        // Create a new entry in the database
        $this->crawler = $this->client->request('GET', '/teacher/');
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());
        $this->crawler = $this->client->click($this->crawler->selectLink('Nouvel utilisateur')->link());
    }

    private function fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond, $followRedirect = true) {
        // Fill in the form and submit it
        $form = $this->crawler->selectButton('Créer le compte')->form(array(
            $this->FIELD_PREFIX . '[lastName]' => $lastName,
            $this->FIELD_PREFIX . '[firstName]' => $firstName,
            $this->FIELD_PREFIX . '[phoneNumber]' => $phoneNumber,
            $this->FIELD_PREFIX . '[cellphoneNumber]' => $cellPhoneNumber,
            $this->FIELD_PREFIX . '[emailAddress]' => $emailAddress,
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