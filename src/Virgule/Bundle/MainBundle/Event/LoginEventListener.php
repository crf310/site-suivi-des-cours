<?php

namespace Virgule\Bundle\MainBundle\Event;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Virgule\Bundle\MainBundle\Entity\Teacher as Teacher;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

class LoginEventListener {

    protected $entityManager;

    public function __construct(EntityManager $em) {
        $this->entityManager = $em;
    }

    /**
     * Catches the login of a user and does something with it
     *
     * @param \Symfony\Component\Security\Http\Event\InteractiveLoginEvent $event
     * @return void
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        $token = $event->getAuthenticationToken();
        if ($token && $token->getUser() instanceof Teacher) {
            $teacher = $token->getUser();
            $teacher->setLastConnectionDate(new \DateTime('now'));
            $this->entityManager->flush();

            $request = $event->getRequest();
            $session = $request->getSession();

            $organizationBranchId = $request->get('organization_branch_id');
            $organizationBranch = $this->entityManager->getRepository('Virgule\Bundle\MainBundle\Entity\OrganizationBranch')->loadOne($organizationBranchId);

            $session->set('organizationBranch', $organizationBranch);
            $session->set('organizationBranchId', $organizationBranchId);
            $session->set('organizationBranchName', $organizationBranch->getName());
            
            try {
                $currentSemester = $this->entityManager->getRepository('Virgule\Bundle\MainBundle\Entity\Semester')->loadCurrent($organizationBranchId);
            } catch (NoResultException $e) {
                $currentSemester =  $this->entityManager->getRepository('Virgule\Bundle\MainBundle\Entity\Semester')->loadLast($organizationBranchId);
            }
            $allSemesters = $this->entityManager->getRepository('Virgule\Bundle\MainBundle\Entity\Semester')->loadAll($organizationBranchId);
            
            $session->set('currentSemester', $currentSemester);
            $session->set('allSemesters', $allSemesters);
        }
    }

}

?>