<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\ClassLevel;

class LoadClassLevelData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $classLevel1 = new ClassLevel();
    $classLevel1->setLabel('Class level 1');
    $classLevel1->setPosition(1);
    $classLevel1->setHtmlColorCode('#FF0000');

    $classLevel2 = new ClassLevel();
    $classLevel2->setLabel('Class level 2');
    $classLevel2->setPosition(2);
    $classLevel2->setHtmlColorCode('#00FF00');

    $classLevel3 = new ClassLevel();
    $classLevel3->setLabel('Class level 3');
    $classLevel3->setPosition(3);
    $classLevel3->setHtmlColorCode('#0000FF');

    $manager->persist($classLevel1);
    $manager->persist($classLevel2);
    $manager->persist($classLevel3);

    $this->addReference('classlevel-1', $classLevel1);
    $this->addReference('classlevel-2', $classLevel2);
    $this->addReference('classlevel-3', $classLevel3);

    $manager->flush();
  }

  public function getOrder() {
    return 5;
  }

}

?>
