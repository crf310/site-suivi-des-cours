<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AbstractControllerTest extends WebTestCase {
    protected $client;
    protected $crawler;
    
    protected $ADMIN_USERNAME = "prof1";
    
    protected $ADMIN_PASSWORD = "password";

    protected function login($username, $password) {
        $this->crawler = $this->client->request('GET', '/login');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Fill in the form and submit it
        $form = $this->crawler->selectButton('Connexion')->form(array(
            '_username' => $username,
            '_password' => $password
                ));

        $this->crawler = $this->client->submit($form);
    }

}

?>