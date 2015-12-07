<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Semester;
use Virgule\Bundle\MainBundle\Entity\OpenHouse;

/**
 * Description of LoadSemesterData
 *
 * @author Guillaume Lucazeau
 */
class LoadSemesterData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $semester1 = new Semester();
    $semester1->setStartDate(new \DateTime('2010-09-25'));
    $semester1->setEndDate(new \DateTime('2011-06-15'));
    $semester1->setOrganizationBranch($this->getReference('deleg-3-10'));

    $semester2 = new Semester();
    $semester2->setStartDate(new \DateTime('2011-09-02'));
    $semester2->setEndDate(new \DateTime('2012-06-02'));
    $semester2->setOrganizationBranch($this->getReference('deleg-3-10'));

    $semester3 = new Semester();
    $semester3->setStartDate(new \DateTime('2012-09-02'));
    $semester3->setEndDate(new \DateTime('2013-06-01'));
    $semester3->setOrganizationBranch($this->getReference('deleg-3-10'));

    $semester4 = new Semester();
    $semester4->setStartDate(new \DateTime('2012-09-10'));
    $semester4->setEndDate(new \DateTime('2013-06-30'));
    $semester4->setOrganizationBranch($this->getReference('deleg-5'));


    $manager->persist($semester1);
    $manager->persist($semester2);
    $manager->persist($semester3);
    $manager->persist($semester4);

    $this->addReference('previousSemester', $semester2);
    $this->addReference('lastSemester', $semester3);

    $manager->flush();

    $oh1 = new OpenHouse();
    $oh1->setDate(new \DateTime('2012-09-01'));
    $oh1->setSemester($semester3);
    $oh1->setStartTime(new \DateTime('10:00'));
    $oh1->setEndTime(new \DateTime('18:00'));

    $oh2 = new OpenHouse();
    $oh2->setDate(new \DateTime('2012-08-30'));
    $oh2->setSemester($semester3);
    $oh2->setStartTime(new \DateTime('10:00'));
    $oh2->setEndTime(new \DateTime('18:00'));

    $manager->persist($oh1);
    $manager->persist($oh2);
    $manager->flush();
  }

  public function getOrder() {
    return 12;
  }

}

?>
