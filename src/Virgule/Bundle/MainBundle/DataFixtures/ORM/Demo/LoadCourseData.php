<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Course;

/**
 * Description of LoadCourseData
 *
 * @author Guillaume Lucazeau
 */

class LoadCourseData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {       
        $course1 = new Course();
        $course1->setDayOfWeek(2);
        $course1->setStartTime(new \DateTime('18:00'));
        $course1->setEndTime(new \DateTime('19:30'));
        $course1->setOrganizationBranch($this->getReference('deleg-3-10'));
        $course1->setClassRoom($this->getReference('salle-cours'));
        $course1->setSemester($this->getReference('lastSemester'));
        $course1->setClassLevel($this->getReference('A1'));
        $course1->addTeacher($this->getReference('prof1'));
        
        $course2 = new Course();
        $course2->setDayOfWeek(2);
        $course2->setStartTime(new \DateTime('10:00'));
        $course2->setEndTime(new \DateTime('11:30'));
        $course2->setOrganizationBranch($this->getReference('deleg-3-10'));
        $course2->setClassRoom($this->getReference('salle-cours'));
        $course2->setSemester($this->getReference('lastSemester'));
        $course2->setClassLevel($this->getReference('A2'));
        $course2->addTeacher($this->getReference('prof2'));
        
        $course3 = new Course();
        $course3->setDayOfWeek(3);
        $course3->setStartTime(new \DateTime('09:00'));
        $course3->setEndTime(new \DateTime('11:30'));
        $course3->setOrganizationBranch($this->getReference('deleg-3-10'));
        $course3->setClassRoom($this->getReference('salle-cours'));
        $course3->setSemester($this->getReference('lastSemester'));
        $course3->setClassLevel($this->getReference('A2'));
        $course3->addTeacher($this->getReference('prof2'));
        $course3->addTeacher($this->getReference('prof4'));
        
        $course4 = new Course();
        $course4->setDayOfWeek(4);
        $course4->setStartTime(new \DateTime('14:00'));
        $course4->setEndTime(new \DateTime('15:30'));
        $course4->setOrganizationBranch($this->getReference('deleg-3-10'));
        $course4->setClassRoom($this->getReference('salle-cours'));
        $course4->setSemester($this->getReference('lastSemester'));
        $course4->setClassLevel($this->getReference('A1'));
        $course4->addTeacher($this->getReference('prof2'));
        
        $manager->persist($course1);
        $manager->persist($course2);
        $manager->persist($course3);
        $manager->persist($course4);
        
        $this->addReference('course1', $course1);
        $this->addReference('course2', $course2);
        $this->addReference('course3', $course3);
        $this->addReference('course4', $course4);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 14;
    }
}

?>
