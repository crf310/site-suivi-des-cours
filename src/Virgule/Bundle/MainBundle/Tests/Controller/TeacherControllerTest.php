<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class TeacherControllerTest extends AbstractControllerTest {

    private $FIELD_PREFIX = 'virgule_bundle_mainbundle_teachertype';

    public function testUserCreationSuccess() {
        // Create a new client to browse the application
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/');
        
        $crawler = $this->login($client, $crawler, $this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);
        $crawler = goToUserCreationForm($crawler);
        $crawler = $this->fillAndSubmitForm($crawler, "John", "Doe", "0102030405", "0504030201", "john.doe@example.com", "jdoe", "password", "password");
        
        $this->checkValue("John");
        $this->checkValue("Doe");
        $this->checkValue("0102030405");
        $this->checkValue("0504030201");
        $this->checkValue("john.doe@example.com");        
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

    private function goToUserCreationForm($crawler) {
        // Create a new entry in the database
        $crawler = $client->request('GET', '/teacher/');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $crawler = $client->click($crawler->selectLink('Nouvel utilisateur')->link());

        return $crawler;
    }

    private function fillAndSubmitForm($crawler, $firstName, $lastName, $phoneNumber, $cellPhoneNumber, $emailAddress, $userName, $passwordFirst, $passwordSecond) {
        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer le compte')->form(array(
            $this->FIELD_PREFIX . '[lastName]' => $firstName,
            $this->FIELD_PREFIX . '[firstName]' => $lastName,
            $this->FIELD_PREFIX . '[phoneNumber]' => $phoneNumber,
            $this->FIELD_PREFIX . '[cellPhoneNumber]' => $cellPhoneNumber,
            $this->FIELD_PREFIX . '[emailAddress]' => $emailAddress,
            $this->FIELD_PREFIX . '[username]' => $userName,
            $this->FIELD_PREFIX . '[password][first]' => $passwordFirst,
            $this->FIELD_PREFIX . '[password][second]' => $passwordSecond,
                ));

        $client->submit($form);
        $crawler = $client->followRedirect();
    }

    
    private function checkValue($crawler, $value) {
        // Check the element contains an attribute with value equals "Foo"
        $this->assertTrue($crawler->filter('html:contains("' . $value . '")')->count() > 0);
    }
}