<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\ClassLevel;

/**
 * Description of LoadClassLevelData
 *
 * @author Guillaume Lucazeau
 */

class LoadClassLevelData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {       
        $level1 = new ClassLevel();
        $level1->setLabel("A1");
        $level1->setHtmlColorCode("#314E8C");
        
        $level2 = new ClassLevel();
        $level2->setLabel("A2");
        $level2->setHtmlColorCode("#7CCAF4");
        
        $level3 = new ClassLevel();
        $level3->setLabel("Alpha");
        $level3->setHtmlColorCode("#008000");
        
        $level4 = new ClassLevel();
        $level4->setLabel("B1/1");
        $level4->setHtmlColorCode("#FF8000");
        
        $level5 = new ClassLevel();
        $level5->setLabel("B1/2");
        $level5->setHtmlColorCode("#FFD0A0");
        
        $level6 = new ClassLevel();
        $level6->setLabel("B2");
        $level6->setHtmlColorCode("#800080");
        
        $level7 = new ClassLevel();
        $level7->setLabel("B3");
        $level7->setHtmlColorCode("#C080C0");        
        
        $manager->persist($level1);
        $manager->persist($level2);
        $manager->persist($level3);
        $manager->persist($level4);
        $manager->persist($level5);
        $manager->persist($level6);
        $manager->persist($level7);
        
        $this->addReference('A1', $level1);
        $this->addReference('A2', $level2);
        $this->addReference('Alpha', $level3);
        $this->addReference('B1/1', $level4);
        $this->addReference('B1/2', $level5);
        $this->addReference('B2', $level6);
        $this->addReference('B3', $level7);
        
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 12;
    }
}

?>
