<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Semester;

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
        $semester2->setOrganizationBranch($this->getReference('deleg-3-10'));
        
        $manager->persist($semester1);
        $manager->persist($semester2);
        $manager->persist($semester3);
        
        $this->addReference('previousSemester', $semester2);
        $this->addReference('lastSemester', $semester3);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}

?>
