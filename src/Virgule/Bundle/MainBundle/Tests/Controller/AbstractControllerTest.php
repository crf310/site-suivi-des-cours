<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractControllerTest extends WebTestCase {
    protected $client;
    protected $crawler;
    
    protected $ADMIN_USERNAME = "prof2";
    
    protected $ADMIN_PASSWORD = "password";
    
    protected $ADMIN_FIRSTNAME = "John";
    
    protected $ADMIN_LASTNAME = "Keating";

    protected function login($username, $password) {
        $this->crawler = $this->client->request('GET', '/login');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Fill in the form and submit it
        $form = $this->crawler->selectButton('Connexion')->form(array(
            '_username' => $username,
            '_password' => $password
                ));

        $this->crawler = $this->client->submit($form);
        
        $this->client->followRedirect();
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());
    }
    
    protected function logout() {        
        $this->crawler = $this->client->request('GET', '/logout');
    }

}

?>