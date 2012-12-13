<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Virgule\Bundle\MainBundle\Entity\Teacher;

/**
 * Description of LoadTeacherData
 *
 * @author Guillaume Lucazeau
 */

class LoadTeacherData implements FixtureInterface {
    public function load(ObjectManager $manager) {       
        $prof1 = new Teacher();
        $prof1->setUsername("prof1");
        $prof1->setPassword("password");
        $prof1->setFirstName("Henry");
        $prof1->setLastName("Jones");
        $prof1->setEmailAddress("henry.jones@example.com");
        $prof1->setRegistrationDate(new \DateTime('now'));
        
        $prof2 = new Teacher();
        $prof2->setUsername("prof2");
        $prof2->setPassword("password");
        $prof2->setFirstName("John");
        $prof2->setLastName("Keating");
        $prof2->setEmailAddress("john.keating@example.com");
        $prof2->setRegistrationDate(new \DateTime('now'));

        $prof3 = new Teacher();
        $prof3->setUsername("prof3");
        $prof3->setPassword("password");
        $prof3->setFirstName("Walter");
        $prof3->setLastName("Lewin");
        $prof3->setEmailAddress("walter.lewin@example.com");
        $prof3->setRegistrationDate(new \DateTime('now'));
        
        $manager->persist($prof1);
        $manager->persist($prof2);
        $manager->persist($prof3);
                
        $manager->flush();
    }
}

?>
