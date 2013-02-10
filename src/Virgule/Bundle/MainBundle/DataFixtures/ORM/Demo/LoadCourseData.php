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
        
        $semesterReferences = Array('lastSemester', 'previousSemester');
        
        $numCourse = 0;
        foreach ($semesterReferences as $semesterReference) {
            
            $courseA = new Course();
            $courseA->setDayOfWeek(2);
            $courseA->setStartTime(new \DateTime('18:00'));
            $courseA->setEndTime(new \DateTime('19:30'));
            $courseA->setOrganizationBranch($this->getReference('deleg-3-10'));
            $courseA->setClassRoom($this->getReference('salle-cours'));
            $courseA->setSemester($this->getReference($semesterReference));
            $courseA->setClassLevel($this->getReference('A1'));
            $courseA->addTeacher($this->getReference('prof1'));

            $courseB = new Course();
            $courseB->setDayOfWeek(2);
            $courseB->setStartTime(new \DateTime('10:00'));
            $courseB->setEndTime(new \DateTime('11:30'));
            $courseB->setOrganizationBranch($this->getReference('deleg-3-10'));
            $courseB->setClassRoom($this->getReference('salle-cours'));
            $courseB->setSemester($this->getReference($semesterReference));
            $courseB->setClassLevel($this->getReference('A2'));
            $courseB->addTeacher($this->getReference('prof2'));

            $courseC = new Course();
            $courseC->setDayOfWeek(3);
            $courseC->setStartTime(new \DateTime('09:00'));
            $courseC->setEndTime(new \DateTime('11:30'));
            $courseC->setOrganizationBranch($this->getReference('deleg-3-10'));
            $courseC->setClassRoom($this->getReference('salle-cours'));
            $courseC->setSemester($this->getReference($semesterReference));
            $courseC->setClassLevel($this->getReference('A2'));
            $courseC->addTeacher($this->getReference('prof2'));
            $courseC->addTeacher($this->getReference('prof4'));

            $courseD = new Course();
            $courseD->setDayOfWeek(4);
            $courseD->setStartTime(new \DateTime('14:00'));
            $courseD->setEndTime(new \DateTime('15:30'));
            $courseD->setOrganizationBranch($this->getReference('deleg-3-10'));
            $courseD->setClassRoom($this->getReference('salle-cours'));
            $courseD->setSemester($this->getReference($semesterReference));
            $courseD->setClassLevel($this->getReference('A1'));
            $courseD->addTeacher($this->getReference('prof2'));

            $courseE = new Course();
            $courseE->setDayOfWeek(4);
            $courseE->setStartTime(new \DateTime('14:00'));
            $courseE->setEndTime(new \DateTime('15:30'));
            $courseE->setOrganizationBranch($this->getReference('deleg-3-10'));
            $courseE->setClassRoom($this->getReference('musee'));
            $courseE->setSemester($this->getReference($semesterReference));
            $courseE->setClassLevel($this->getReference('A1'));
            $courseE->addTeacher($this->getReference('prof3'));
            
            $manager->persist($courseA);
            $manager->persist($courseB);
            $manager->persist($courseC);
            $manager->persist($courseD);
            $manager->persist($courseE);

            $this->addReference('course' . ($numCourse + 1), $courseA);
            $this->addReference('course' . ($numCourse + 2), $courseB);
            $this->addReference('course' . ($numCourse + 3), $courseC);
            $this->addReference('course' . ($numCourse + 4), $courseD);
            $this->addReference('course' . ($numCourse + 5), $courseE);
            $manager->flush();
            
            $numCourse += 5;
        }
        
    }
    
    public function getOrder() {
        return 14;
    }
}

?>
