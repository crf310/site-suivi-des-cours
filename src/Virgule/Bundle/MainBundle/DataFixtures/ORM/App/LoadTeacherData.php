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
        
        $manager->persist($userAdmin);
                
        $manager->flush();
    }
}

?>
