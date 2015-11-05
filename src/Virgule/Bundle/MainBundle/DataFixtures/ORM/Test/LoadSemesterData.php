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
        $currentStartDate = new \DateTime();
        $currentStartDate->modify('-30 day');
        $currentEndDate = new \DateTime();
        $currentEndDate->modify('+30 day');

        $previousStartDate = new \DateTime();
        $previousStartDate->modify('-90 day');
        $previousEndDate = new \DateTime();
        $previousEndDate->modify('-60 day');

        // current semester
        $currentSemester = new Semester();
        $currentSemester->setStartDate($currentStartDate);
        $currentSemester->setEndDate($currentEndDate);
        $currentSemester->setOrganizationBranch($this->getReference('organization-1'));

        // previous semester
        $previousSemester = new Semester();
        $previousSemester->setStartDate($previousStartDate);
        $previousSemester->setEndDate($previousEndDate);
        $previousSemester->setOrganizationBranch($this->getReference('organization-1'));

        // current semester (different org & start date == current date)
        $currentSemesterOrg2 = new Semester();
        $currentSemesterOrg2->setStartDate(new \DateTime());
        $currentSemesterOrg2->setEndDate($currentEndDate);
        $currentSemesterOrg2->setOrganizationBranch($this->getReference('organization-2'));

        // current semester (different org & end date == current date)
        $currentSemesterOrg3 = new Semester();
        $currentSemesterOrg3->setStartDate($currentStartDate);
        $currentSemesterOrg3->setEndDate(new \DateTime());
        $currentSemesterOrg3->setOrganizationBranch($this->getReference('organization-3'));

        // previous semester (different org)
        $previousSemesterOrg2 = new Semester();
        $previousSemesterOrg2->setStartDate($previousStartDate);
        $previousSemesterOrg2->setEndDate($previousEndDate);
        $previousSemesterOrg2->setOrganizationBranch($this->getReference('organization-2'));

        $manager->persist($currentSemester);
        $manager->persist($previousSemester);
        $manager->persist($currentSemesterOrg2);
        $manager->persist($currentSemesterOrg3);
        $manager->persist($previousSemesterOrg2);

        $manager->flush();


    }

    public function getOrder() {
        return 2;
    }
}

?>
