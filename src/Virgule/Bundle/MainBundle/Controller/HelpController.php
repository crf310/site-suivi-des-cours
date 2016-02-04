<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Admin controller.
 *
 * @Route("/help")
 */
class HelpController extends AbstractVirguleController {

  /**
   * Show help page
   *
   * @Route("/faq", name="help_faq")
   * @Method({"GET"})
   * @Template
   */
  public function helpAction() {
    $user_manual_url = $this->container->getParameter('user_manual_url');
    return array(
        'user_manual_url' => $user_manual_url,
    );
  }

}
