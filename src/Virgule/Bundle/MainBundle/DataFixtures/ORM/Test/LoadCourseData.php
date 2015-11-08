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
        $course1->addTeacher($this->getReference('user-1'));

        $course2 = new Course();
        $course2->setDayOfWeek(2);
        $course2->setStartTime(new \DateTime('1000'));
        $course2->setEndTime(new \DateTime('1130'));
        $course2->setSemester($this->getReference('semester-11'));
        $course2->setClassLevel($this->getReference('classlevel-1'));
        $course2->setOrganizationBranch($this->getReference('organization-1'));
        $course2->setClassRoom($this->getReference('classroom-11'));
        $course2->addTeacher($this->getReference('user-1'));
        
        // different teacher
        $course3 = new Course();
        $course3->setDayOfWeek(2);
        $course3->setStartTime(new \DateTime('1000'));
        $course3->setEndTime(new \DateTime('1130'));
        $course3->setSemester($this->getReference('semester-11'));
        $course3->setClassLevel($this->getReference('classlevel-1'));
        $course3->setOrganizationBranch($this->getReference('organization-1'));
        $course3->setClassRoom($this->getReference('classroom-11'));
        $course3->addTeacher($this->getReference('user-2'));
        
        $manager->persist($course1);
        $manager->persist($course2);
        $manager->persist($course3);
        
        $manager->flush();
    }

    public function getOrder() {
        return 6;
    }
}

?>
