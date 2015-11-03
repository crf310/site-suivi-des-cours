<?php

namespace Virgule\Bundle\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase {

  private $client;
  private $SITE_NAME = "Service AALF";
  private $USERNAME = 'user1';
  private $PASSWORD = 'user1';

  private function callRouteAndAssertSuccess($route) {
    $this->client = static::createClient();
    $this->client->followRedirects();
    $crawler = $this->client->request('GET', $route);
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    $this->assertTrue($crawler->filter('html:contains("' . $this->SITE_NAME . '")')->count() == 1);
    return $crawler;
  }

  private function fillAndSubmitLoginForm($crawler, $username, $password) {
    // Fill in the form and submit it
    $form = $crawler->selectButton('Connexion')->form(array(
        '_username' => $username,
        '_password' => $password
    ));

    return $this->client->submit($form);
  }

  /**
   * @test
   */
  public function defaultRoute_routeCalled_loginPageIsDisplayed() {
    $this->callRouteAndAssertSuccess('/');
  }

  /**
   * @test
   */
  public function loginRoute_routeCalled_loginPageIsDisplayed() {
    $this->callRouteAndAssertSuccess('/login');
  }

  /**
   * @test
   */
  public function loginForm_userSubmitsInvalidCredentials_staysOnLoginForm() {
    $crawler = $this->callRouteAndAssertSuccess('/login');
    $crawler = $this->fillAndSubmitLoginForm($crawler, 'Toto', 'Toto');

    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    $this->assertTrue($crawler->filter('html:contains("' . $this->SITE_NAME . '")')->count() == 1);
  }

  /**
   * @test
   */
  public function loginForm_userSubmitsValidCredentials_homePageIsDisplayed() {
    $crawler = $this->callRouteAndAssertSuccess('/login');

    $crawler = $this->fillAndSubmitLoginForm($crawler, $this->USERNAME, $this->PASSWORD);
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $crawler = $this->client->click($crawler->selectLink('Déconnexion')->link());
    $this->assertTrue($crawler->filter('input[placeholder="Nom d\'utilisateur"]')->count() == 1);
    $this->assertTrue($crawler->filter('input[placeholder="Mot de passe"]')->count() == 1);
    $this->assertFalse($crawler->filter("html:contains('Henry Jones')")->count() >= 1);
  }

}

?>