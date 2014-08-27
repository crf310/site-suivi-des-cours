<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Form\ReportIssueType;

/**
 * Admin controller.
 *
 * @Route("/help")
 */
class HelpController extends AbstractVirguleController {

    /**
     * Display the form and send the issue to github
     *
     * @Route("/reportIssue", name="report_issue")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function reportIssueAction(Request $request) {
        $form = $this->createForm(new ReportIssueType());
        
        $this->getHelpManager()->reportIssue();
        
        if ($request->getMethod() == 'POST') {
            
        }
        return Array(
            'form' => $form->createView(),
        );
    }

}
