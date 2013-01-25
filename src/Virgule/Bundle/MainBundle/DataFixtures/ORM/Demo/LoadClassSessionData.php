<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\ClassSession;

/**
 * Description of LoadCourseData
 *
 * @author Guillaume Lucazeau
 */
class LoadClassSessionData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $summary = "<b>Lorem ipsum dolor sit amet</b>, <i>consectetur adipisicing elit</i>, <u>sed do eiusmod tempor incididunt ut labore </u>et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
        for ($c = 1; $c <= 4; $c++) {
            for ($i = 1; $i <= 4; $i++) {
                $course = $this->getReference('course' . $c);
                $cs = new ClassSession();
                $cs->setCourse($course);
                $cs->setDate(new \DateTime('now'));
                $cs->setSessionTeacher($course->getTeacher());
                $cs->setReportTeacher($course->getTeacher());
                $cs->setSummary($summary);

                $manager->persist($cs);
            }
        }

        $manager->flush();
    }

    public function getOrder() {
        return 15;
    }

}

?>
