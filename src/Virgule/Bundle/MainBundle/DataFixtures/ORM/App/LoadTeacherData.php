<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\App;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Virgule\Bundle\MainBundle\Entity\Teacher;

/**
 * Description of LoadTeacherData
 *
 * @author Guillaume Lucazeau
 */

class LoadTeacherData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new Teacher();
        $userAdmin->setUsername('root');
        $userAdmin->setPassword('root1234');        
        $userAdmin->setFirstName("Root");
        $userAdmin->setLastName("User");
        $userAdmin->setRegistrationDate(new \DateTime('now'));
        $userAdmin->setFkRoleId($manager->merge($this->getReference('admin-role')));

        $manager->persist($userAdmin);
                
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}

?>
