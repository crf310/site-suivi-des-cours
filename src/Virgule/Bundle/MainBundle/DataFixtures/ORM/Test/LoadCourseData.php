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
        $course1->setSemester($this->getReference('org-1-semester-1'));
        $course1->setClassLevel($this->getReference('classlevel-1'));
        $course1->setOrganizationBranch($this->getReference('organization-1'));
        $course1->setClassRoom($this->getReference('classroom-11'));
        $course1->addTeacher($this->getReference('user-1'));
        $course1->addStudent($this->getReference('student-1'));
        $course1->addStudent($this->getReference('student-2'));

        $course2 = new Course();
        $course2->setDayOfWeek(2);
        $course2->setStartTime(new \DateTime('1000'));
        $course2->setEndTime(new \DateTime('1130'));
        $course2->setSemester($this->getReference('org-1-semester-1'));
        $course2->setClassLevel($this->getReference('classlevel-1'));
        $course2->setOrganizationBranch($this->getReference('organization-1'));
        $course2->setClassRoom($this->getReference('classroom-11'));
        $course2->addTeacher($this->getReference('user-1'));
        $course2->addStudent($this->getReference('student-1'));
        
        // different teacher
        $course3 = new Course();
        $course3->setDayOfWeek(2);
        $course3->setStartTime(new \DateTime('1000'));
        $course3->setEndTime(new \DateTime('1130'));
        $course3->setSemester($this->getReference('org-1-semester-1'));
        $course3->setClassLevel($this->getReference('classlevel-1'));
        $course3->setOrganizationBranch($this->getReference('organization-1'));
        $course3->setClassRoom($this->getReference('classroom-11'));
        $course3->addTeacher($this->getReference('user-2'));
        
        // different room
        $course4 = new Course();
        $course4->setDayOfWeek(2);
        $course4->setStartTime(new \DateTime('1000'));
        $course4->setEndTime(new \DateTime('1130'));
        $course4->setSemester($this->getReference('org-1-semester-1'));
        $course4->setClassLevel($this->getReference('classlevel-1'));
        $course4->setOrganizationBranch($this->getReference('organization-1'));
        $course4->setClassRoom($this->getReference('classroom-12'));
        $course4->addTeacher($this->getReference('user-2'));        
        
        // different semester
        $course5 = new Course();
        $course5->setDayOfWeek(2);
        $course5->setStartTime(new \DateTime('1000'));
        $course5->setEndTime(new \DateTime('1130'));
        $course5->setSemester($this->getReference('org-1-semester-2'));
        $course5->setClassLevel($this->getReference('classlevel-1'));
        $course5->setOrganizationBranch($this->getReference('organization-1'));
        $course5->setClassRoom($this->getReference('classroom-12'));
        $course5->addTeacher($this->getReference('user-2'));        
        $course5->addStudent($this->getReference('student-1'));
        
        $this->addReference('org-1-semester-1-course-1', $course1);
        $this->addReference('org-1-semester-1-course-2', $course2);
        $this->addReference('org-1-semester-1-course-3', $course3);
        $this->addReference('org-1-semester-1-course-4', $course4);
        $this->addReference('org-1-semester-2-course-1', $course5);
        
        $manager->persist($course1);
        $manager->persist($course2);
        $manager->persist($course3);
        $manager->persist($course4);
        $manager->persist($course5);
        
        $manager->flush();
    }

    public function getOrder() {
        return 7;
    }
}

?>
