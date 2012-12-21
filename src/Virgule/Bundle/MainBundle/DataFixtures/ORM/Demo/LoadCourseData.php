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
        $course1->setStartTime(new \ DateTime('18:00'));
        $course1->setEndTime(new \ DateTime('19:30'));
        $course1->setOrganizationBranch($this->getReference('deleg-3-10'));
        $course1->setClassRoom($this->getReference('salle-cours'));
        $course1->setSemester($this->getReference('lastSemester'));
        $course1->setClassLevel($this->getReference('A1'));
        $course1->setTeacher($this->getReference('prof1'));
        
        $course2 = new Course();
        $course2->setDayOfWeek(2);
        $course2->setStartTime(new \ DateTime('10:00'));
        $course2->setEndTime(new \ DateTime('11:30'));
        $course2->setOrganizationBranch($this->getReference('deleg-3-10'));
        $course2->setClassRoom($this->getReference('salle-cours'));
        $course2->setSemester($this->getReference('lastSemester'));
        $course2->setClassLevel($this->getReference('A2'));
        $course2->setTeacher($this->getReference('prof2'));
        
        $manager->persist($course1);
        $manager->persist($course2);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 4;
    }
}

?>
