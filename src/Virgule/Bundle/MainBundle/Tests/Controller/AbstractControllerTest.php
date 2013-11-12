<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AbstractControllerTest extends WebTestCase {
    protected $ADMIN_USERNAME = "prof1";
    
    protected $ADMIN_PASSWORD = "password";

    protected function login($client, $crawler, $username, $password) {
        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Connexion')->form(array(
            '_username' => $username,
            '_password' => $password
                ));

        $crawler = $client->submit($form);
        return $crawler;
    }

}

?>