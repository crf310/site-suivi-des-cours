<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Test;

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
        $startDate = new \DateTime();
        $startDate->modify('-30 day');
        
        
        $endDate = new \DateTime();
        $endDate->modify('+30 day');
        
        // current semester
        $currentSemester = new Semester();
        $currentSemester->setStartDate($startDate);
        $currentSemester->setEndDate($endDate);
        $currentSemester->setOrganizationBranch($this->getReference('organization-1'));

        $manager->persist($currentSemester);
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}

?>
