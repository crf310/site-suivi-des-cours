<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractControllerTest extends WebTestCase {
    protected $client;
    protected $crawler;
    
    protected $ADMIN_USERNAME = "root";
    
    protected $ADMIN_PASSWORD = "root1234";
    
    protected $USER_USERNAME = "user1";
    
    protected $USER_PASSWORD = "user1";
    
    protected $USER_FIRSTNAME = 'User';
    
    protected $USER_LASTNAME = 'Active 1';
    
    protected $ORG_BRANCH_NAME = "Delegation 1";

    protected function login($username, $password) {
        $this->crawler = $this->client->request('GET', '/login');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Fill in the form and submit it
        $form = $this->crawler->selectButton('Connexion')->form(array(
            '_username' => $username,
            '_password' => $password
                ));

        $this->crawler = $this->client->submit($form);
        
        $this->crawler = $this->client->followRedirect();
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->crawler->filter("div#loginerror:contains('droits invalides')")->count() == 0, "Login: droits invalides");
        $this->assertTrue($this->crawler->filter("span:contains('Accueil')")->count() == 1, "Accueil link not found");
    }
    
    protected function logout() {        
        $this->crawler = $this->client->request('GET', '/logout');
        $this->crawler = $this->client->followRedirect();
    }
    
    protected function goToDashboard() {
        $this->crawler = $this->client->request('GET', '/welcome');
        
    }
}

?>