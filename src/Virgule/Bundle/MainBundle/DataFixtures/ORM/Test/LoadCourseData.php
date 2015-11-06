<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Course;

class LoadCourseData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
        $course1 = new Course();
        $course1->setDayOfWeek(1);
        $course1->setStartTime(new \DateTime('0800'));
        $course1->setEndTime(new \DateTime('0930'));
        $course1->setSemester($this->getReference('semester-11'));
        $course1->setClassLevel($this->getReference('classlevel-1'));
        $course1->setOrganizationBranch($this->getReference('organization-1'));
        $course1->setClassRoom($this->getReference('classroom-11'));

        $manager->persist($course1);
        $manager->flush();
    }

    public function getOrder() {
        return 6;
    }
}

?>
