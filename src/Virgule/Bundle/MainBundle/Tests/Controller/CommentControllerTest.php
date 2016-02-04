<?php

namespace Virgule\Bundle\MainBundle\Tests\Controller;

use Virgule\Bundle\MainBundle\Tests\Controller\AbstractControllerTest;

class CommentControllerTest extends AbstractControllerTest {

  private $FIELD_PREFIX = 'virgule_bundle_mainbundle_commenttype';

  /**
   * @test
   */
  public function createStudentCommentAction_commentIsAdded_commentTextIsShownOnTheStudentPage() {
    $comment = 'This is a new comment at ' . time();
    $date = new \DateTime('now');
    
    $this->client = static::createClient();
    $this->crawler = $this->client->request('GET', '/');

    $this->login($this->ADMIN_USERNAME, $this->ADMIN_PASSWORD);

    $this->goToRoute('/student/1/show');
    $this->assertPageContainsTitle('Firstname 1 LASTNAME 1');
    
    $this->fillAndSubmitCommentForm($comment, true);
    $this->assertPageContainsTitle('Firstname 1 LASTNAME 1');
    $this->assertTrue($this->crawler->filterXPath("//div[@class=\"comments\"]/span[@class='user-info' and contains(text(), '" . $date->format('d/m/Y') . "')]")->count() == 1, "Comment not found");
    $this->assertTrue($this->crawler->filterXPath("//div[@class=\"comments\"]/p[text()='" . $comment . "']")->count() == 1, "Comment not found");

    $this->logout();
  }

  private function fillAndSubmitCommentForm($comment, $followRedirect) {
    $form = $this->getFormById('comment-form');
    $form[$this->FIELD_PREFIX . '[comment]'] = $comment;

    $this->client->submit($form);

    if ($followRedirect) {
      $this->crawler = $this->client->followRedirect();
    } else {
      $this->crawler = $this->client->reload();
    }
  }

}
