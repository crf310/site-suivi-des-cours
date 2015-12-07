<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\ClassRoom;

class LoadClassRoomData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $classRoom11 = new ClassRoom();
    $classRoom11->setName("Classroom 11");
    $classRoom11->setOrganizationBranch($this->getReference('organization-1'));
    $classRoom11->setAddress("adresse classroom 11");

    $classRoom12 = new ClassRoom();
    $classRoom12->setName("Classroom 12");
    $classRoom12->setOrganizationBranch($this->getReference('organization-1'));
    $classRoom12->setAddress("adresse classroom 12");

    $classRoom21 = new ClassRoom();
    $classRoom21->setName("Classroom 21");
    $classRoom21->setOrganizationBranch($this->getReference('organization-2'));
    $classRoom21->setAddress("adresse classroom 21");

    $classRoom22 = new ClassRoom();
    $classRoom22->setName("Classroom 22");
    $classRoom22->setOrganizationBranch($this->getReference('organization-2'));
    $classRoom22->setAddress("adresse classroom 22");

    $classRoom23 = new ClassRoom();
    $classRoom23->setName("Classroom 23");
    $classRoom23->setOrganizationBranch($this->getReference('organization-2'));
    $classRoom23->setAddress("adresse classroom 23");

    $manager->persist($classRoom11);
    $manager->persist($classRoom12);
    $this->addReference('classroom-11', $classRoom11);
    $this->addReference('classroom-12', $classRoom12);

    $manager->persist($classRoom21);
    $manager->persist($classRoom22);
    $manager->persist($classRoom23);

    $manager->flush();
  }

  public function getOrder() {
    return 4;
  }

}

?>
