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
        $prof1->setCellphoneNumber("0605040302");
        $prof1->setPhoneNumber("0102030405");
        $prof1->setEmailAddress("henry.jones@example.com");
        $prof1->setRegistrationDate(new \DateTime('now'));
        $prof1->setRole($this->getReference('user-role'));
        
        $prof2 = new Teacher();
        $prof2->setUsername("prof2");
        $prof2->setPassword("password");
        $prof2->setFirstName("John");
        $prof2->setLastName("Keating");
        $prof1->setCellphoneNumber("0605040302");
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

        $prof4 = new Teacher();
        $prof4->setUsername("prof4");
        $prof4->setPassword("password");
        $prof4->setFirstName("Philippe");
        $prof4->setLastName("Marrast");
        $prof4->setEmailAddress("philippe.marrast@example.com");
        $prof4->setRegistrationDate(new \DateTime('now'));
        $prof4->setRole($this->getReference('user-role'));
        
        $guest = new Teacher();
        $guest->setUsername("guest");
        $guest->setPassword("password");
        $guest->setFirstName("Ludovic");
        $guest->setLastName("Tessier");
        $guest->setEmailAddress("ludovic.tessier@example.com");
        $guest->setRegistrationDate(new \DateTime('now'));
        $guest->setRole($this->getReference('guest-role'));
        
        $secretary = new Teacher();
        $secretary->setUsername("secretary");
        $secretary->setPassword("password");
        $secretary->setFirstName("Safia");
        $secretary->setLastName("Slimane");
        $secretary->setEmailAddress("safia.slimane@example.com");
        $secretary->setRegistrationDate(new \DateTime('now'));
        $secretary->setRole($this->getReference('secretary-role'));
        
        $manager->persist($prof1);
        $manager->persist($prof2);
        $manager->persist($prof3);
        $manager->persist($prof4);
        $manager->persist($guest);
        $manager->persist($secretary);
        
        $this->addReference('prof1', $prof1);
        $this->addReference('prof2', $prof2);        
        $this->addReference('prof3', $prof3);
        $this->addReference('prof4', $prof4);
        
        for ($i = 10; $i <= 50; $i++) {
            $p = new Teacher();
            $p->setUsername("prof" . $i);
            $p->setPassword("password");
            $p->setFirstName("Jean");
            $p->setLastName("Dupont");
            $p->setEmailAddress("jean.dupont@example.com");
            $p->setRegistrationDate(new \DateTime('now'));
            $p->setRole($this->getReference('guest-role'));

            $manager->persist($p);            
        }
                
        $manager->flush();
    }
    
    public function getOrder() {
        return 3;
    }
}

?>
