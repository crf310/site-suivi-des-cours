<?php

namespace Virgule\Bundle\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase {

    private $crawler;
    public function testCompleteScenario() {
        // Create a new client to browse the application
        $client = static::createClient();

        // Check default URL
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isRedirection('/login'));
        
        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Test wrong credentials
        $this->fillAndSubmitLoginForm($client, $crawler, 'Toto', 'Toto');
        $crawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());       
        $this->assertTrue($crawler->filter('div:contains("identification a échoué")')->count() > 0);
        
        $this->fillAndSubmitLoginForm($client, $crawler, 'prof1', 'password');
        $crawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirection('/welcome'));

    }

    private function fillAndSubmitLoginForm($client, $crawler, $username, $password)  {
        // Fill in the form and submit it
        $form = $crawler->selectButton('Connexion')->form(array(
            '_username' => $username,
            '_password' => $password
            ));

        $client->submit($form);
    }
}
?>