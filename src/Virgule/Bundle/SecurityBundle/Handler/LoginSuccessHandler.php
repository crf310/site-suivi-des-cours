<?php
namespace Virgule\Bundle\SecurityBundle\Handler;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

use Virgule\Bundle\MainBundle\Entity\Teacher as Teacher;

/**
 *
 */
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    protected $router;
    protected $security;
    protected $entityManager;
    protected $container;

    public function __construct(Router $router, SecurityContext $security, EntityManager $entityManager, ContainerInterface $container) {
        $this->router = $router;
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\HttpFoundation\Request                                                     $request
     * @param  \Symfony\Component\Security\Core\Authentication\Token\TokenInterface                          $token
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        if ($token && $token->getUser() instanceof Teacher) {
            $session = $request->getSession();

            $user = $token->getUser();
            if ($user->getUsername() != 'root') {
                $expirationDate = new \DateTime("now");
                $daysBeforeExpiration = $this->container->getParameter('user_account_days_before_expiration');
                $expirationDate->modify('+' . $daysBeforeExpiration . ' day');
                $user->setExpiresAt($expirationDate);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }

            $organizationBranchId = $request->get('organization_branch_id');
            $organizationBranch = $this->entityManager->getRepository('Virgule\Bundle\MainBundle\Entity\OrganizationBranch')->loadOne($organizationBranchId);

            $session->set('organizationBranch', $organizationBranch);
            $session->set('organizationBranchId', $organizationBranchId);
            $session->set('organizationBranchName', $organizationBranch->getName());

            try {
                $currentSemester = $this->entityManager->getRepository('Virgule\Bundle\MainBundle\Entity\Semester')->loadCurrent($organizationBranchId);
            } catch (NoResultException $e) {
                $currentSemester =  $this->entityManager->getRepository('Virgule\Bundle\MainBundle\Entity\Semester')->loadLatest($organizationBranchId);
            }
            $allSemesters = $this->entityManager->getRepository('Virgule\Bundle\MainBundle\Entity\Semester')->loadAll($organizationBranchId);

            $session->set('currentSemester', $currentSemester);
            $session->set('allSemesters', $allSemesters);

            // redirect the user to where they were before the login process begun.
            $referer_url = $request->headers->get('referer');
            if (! empty($referer_url) && (strpos($referer_url,'login') === false)) {
                $response = new RedirectResponse($referer_url);
            } else {
                $response = new RedirectResponse($this->router->generate('welcome'));
            }

            // if credentials expire before 30 days, redirect to password change
            $now = new \DateTime("now");
            $temporaryCredentialsDays = $this->container->getParameter('temporary_credentials_days');
            $userCredentialsExpireAt = $user->getCredentialsExpireAt();
            if (!empty($userCredentialsExpireAt) && $now->diff($userCredentialsExpireAt)->format('%R%a') < $temporaryCredentialsDays) {
                $session->getFlashBag()->add('info', 'Votre mot de passe expire dans moins de ' . $temporaryCredentialsDays . ' jours, veuillez le changer dès maintenant.');
                $response = new RedirectResponse($this->router->generate('fos_user_change_password'));
            }
            return $response;
        }
    }
}
