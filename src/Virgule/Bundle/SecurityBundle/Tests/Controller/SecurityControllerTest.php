<?php

namespace Virgule\Bundle\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase {

    private $SITE_NAME = "Service AALF";
    
    public function testCompleteScenario() {
        // Create a new client to browse the application
        $client = static::createClient();
        $client->followRedirects();
        
        // Check default URL
        $crawler = $client->request('GET', '/');
        
        $this->assertTrue($crawler->filter('html:contains("'.$this->SITE_NAME.'")')->count() == 1);
                
        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("'.$this->SITE_NAME.'")')->count() == 1);
        
        // Test wrong credentials
        $crawler = $this->fillAndSubmitLoginForm($client, $crawler, 'Toto', 'Toto');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("'.$this->SITE_NAME.'")')->count() == 1);
        
        $crawler = $this->fillAndSubmitLoginForm($client, $crawler, 'user1', 'user1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());        
        
        $crawler = $client->click($crawler->selectLink('Déconnexion')->link());
        $this->assertTrue($crawler->filter('input[placeholder="Nom d\'utilisateur"]')->count() == 1);
        $this->assertTrue($crawler->filter('input[placeholder="Mot de passe"]')->count() == 1);
        $this->assertFalse($crawler->filter("html:contains('Henry Jones')")->count() >= 1); 
    }
    
    private function fillAndSubmitLoginForm($client, $crawler, $username, $password)  {
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