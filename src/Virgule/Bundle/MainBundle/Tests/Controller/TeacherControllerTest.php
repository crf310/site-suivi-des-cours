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
        
        $this->assertTrue($this->crawler->filter("html")->count() > 0);
        $this->assertTrue($this->crawler->filter("html:contains('Créer un nouveau compte utilisateur')")->count() == 0);
        
        $this->assertTrue($this->crawler->filter("td:contains('" . $firstName . " " . $lastName . "')")->count() > 0);
        $this->assertTrue($this->crawler->filter("td:contains('01 02 03 04 05')")->count() > 0);
        $this->assertTrue($this->crawler->filter("td:contains('05 04 03 02 01')")->count() > 0);
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

    private function fillAndSubmitForm($firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond) {
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
        //echo $this->client->getResponse()->getContent();// Just add this line
        $this->crawler = $this->client->followRedirect();
    }
}