<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\App;

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
    public function load(ObjectManager $manager)
    {
        $username = "root_new";
        $userAdmin = new Teacher();
        $userAdmin->setUsername($username);
        $userAdmin->setPassword('root1234');        
        $userAdmin->setFirstName($username);
        $userAdmin->setLastName("");
        $userAdmin->setEmail($username . "@example.com");
        $userAdmin->setRegistrationDate(new \DateTime('now'));
        // $userAdmin->setFkRoleId($this->getReference('admin-role')->getId());
        $userAdmin->setRole($this->getReference('admin-role'));
        $userAdmin->setEnabled(true);
        $userAdmin->setLocked(false);
        $userAdmin->setExpired(false);
        $userAdmin->setCredentialsExpired(false);

        $manager->persist($userAdmin);
                
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}

?>
