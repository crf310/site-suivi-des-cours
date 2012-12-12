<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Virgule\Bundle\MainBundle\Entity\Teacher;

/**
 * Description of LoadTeacherData
 *
 * @author Guillaume Lucazeau
 */

class LoadTeacherData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new Teacher();
        $userAdmin->setUsername('root');
        $userAdmin->setPassword('root1234');
        
        $prof1 = new Teacher();
        $prof1->setUsername("prof1");
        $prof1->setPassword("password");
        $prof1->setFirstName("Henry");
        $prof1->setLastName("Jones");
        $prof1->setEmailAddress("henry.jones@example.com");
        
        $prof2 = new Teacher();
        $prof2->setUsername("prof2");
        $prof2->setPassword("password");
        $prof2->setFirstName("John");
        $prof2->setLastName("Keating");
        $prof2->setEmailAddress("john.keating@example.com");
        
        $manager->persist($userAdmin);
        $manager->persist($prof1);
                
        $manager->flush();
    }
}

?>
