<?php

namespace Virgule\Bundle\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Virgule\Bundle\MainBundle\Repository\OrganizationBranchRepository;

class SecurityController extends Controller {
    
    /**
     * Display login form
     *
     * @Route("/", name="start")
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction() {
        $em = $this->getDoctrine()->getManager();

        $organizationBranches = $em->getRepository('VirguleMainBundle:OrganizationBranch')->findAll();
        
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;
        
        return $this->render('VirguleSecurityBundle:Security:login.html.twig', array(
            // last username entered by the user
            'last_username'          => $session->get(SecurityContext::LAST_USERNAME),
            'error'                  => $error,
            'organization_branches'  => $organizationBranches,
            'csrf_token'             => $csrfToken
        ));
    }
    
    /**
     * Display login form
     *
     * @Route("/logout", name="logout")
     * @Template()
     */    
    public function logoutAction() {
        $session = $this->get('session');
        $session->clear();

        return $this->redirect($this->generateUrl('login'));
    }
}
