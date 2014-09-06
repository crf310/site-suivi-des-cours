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
        $classLevels = Array();
        $classLevels[] = Array("label" => "Alpha", "html_color_code" => "#008000");
        $classLevels[] = Array("label" => "A1", "html_color_code" => "#314E8C");
        $classLevels[] = Array("label" => "A2", "html_color_code" => "#7CCAF4");
        $classLevels[] = Array("label" => "B1/1", "html_color_code" => "#FF8000");
        $classLevels[] = Array("label" => "B1/2", "html_color_code" => "#FFD0A0");
        $classLevels[] = Array("label" => "B2", "html_color_code" => "#800080");
        $classLevels[] = Array("label" => "C3", "html_color_code" => "#C080C0");
        
        foreach ($classLevels as $key => $classLevel) {
            $level = new ClassLevel();
            $level->setLabel($classLevel["label"]);
            $level->setHtmlColorCode($classLevel["html_color_code"]);
            $level->setPosition($key+1);  
            $manager->persist($level);            
        
            $this->addReference($classLevel["label"], $level);
        }
        $manager->flush();
    }
    
    public function getOrder() {
        return 12;
    }
}

?>
