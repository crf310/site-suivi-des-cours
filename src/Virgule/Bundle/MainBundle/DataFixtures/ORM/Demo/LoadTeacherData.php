<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

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
        $prof1 = new Teacher();
        $prof1->setUsername("prof1");
        $prof1->setPassword("password");
        $prof1->setFirstName("Henry");
        $prof1->setLastName("Jones");
        $prof1->setCellphoneNumber("06 05 04 03 02");
        $prof1->setPhoneNumber("01 02 03 04 05");
        $prof1->setEmailAddress("henry.jones@example.com");
        $prof1->setRegistrationDate(new \DateTime('now'));
        $prof1->setRole($this->getReference('user-role'));
        
        $prof2 = new Teacher();
        $prof2->setUsername("prof2");
        $prof2->setPassword("password");
        $prof2->setFirstName("John");
        $prof2->setLastName("Keating");
        $prof1->setCellphoneNumber("06 05 04 03 02");
        $prof2->setEmailAddress("john.keating@example.com");
        $prof2->setRegistrationDate(new \DateTime('now'));
        $prof2->setRole($this->getReference('user-role'));

        $prof3 = new Teacher();
        $prof3->setUsername("prof3");
        $prof3->setPassword("password");
        $prof3->setFirstName("Walter");
        $prof3->setLastName("Lewin");
        $prof3->setEmailAddress("walter.lewin@example.com");
        $prof3->setRegistrationDate(new \DateTime('now'));
        $prof3->setRole($this->getReference('user-role'));
        
        $manager->persist($prof1);
        $manager->persist($prof2);
        $manager->persist($prof3);
                
        $manager->flush();
    }
    
    public function getOrder() {
        return 3;
    }
}

?>
