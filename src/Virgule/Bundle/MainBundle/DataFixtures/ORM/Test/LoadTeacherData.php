<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Teacher;

/**
 * Description of LoadTeacherData
 *
 * @author Guillaume Lucazeau
 */
class LoadTeacherData extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {  
        for ($i = 1; $i <= 5; $i++) {
          $this->createTeacher($manager, $i, true);
        }
        
        for ($i = 6; $i <= 7; $i++) {
          $this->createTeacher($manager, $i, false);
        }
        
        $manager->flush();
    }

    private function createTeacher($manager, $i, $active = true) {
        $user = new Teacher();
        $user->setUsername("user" . $i);
        $user->setFirstName("User");
        if ($active) {
          $user->setLastName("Active " . $i);
        } else {
          $user->setLastName("Inactive " . $i);
        }        
        $user->setEmail("user" . $i . "@example.com");
        $user->setRegistrationDate(new \DateTime('now'));
        $user->setRole($this->getReference('user-role'));
        $user->setEnabled(true);
        $user->setLocked(false);
        $user->setExpired(false);
        $user->setCredentialsExpired(false);     
        $user->setPlainPassword('user' . $i);
        $user->setIsActive($active);
        $user->addOrganizationBranch($this->getReference("organization-1"));
        $manager->persist($user);
    }
    public function getOrder() {
        return 3;
    }

}

?>
