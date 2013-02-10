<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\ClassRoom;

/**
 * Description of LoadClassRoomData
 *
 * @author Guillaume Lucazeau
 */

class LoadClassRoomData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {       
        $class1 = new ClassRoom();
        $class1->setName("Salle de cours");
        $class1->setOrganizationBranch($this->getReference('deleg-3-10'));
        
        $class2 = new ClassRoom();
        $class2->setName("Musée");
        $class2->setOrganizationBranch($this->getReference('deleg-3-10'));
        
        $manager->persist($class1);
        $manager->persist($class2);
        
        $this->addReference('salle-cours', $class1);
        $this->addReference('musee', $class2);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 13;
    }
}

?>
