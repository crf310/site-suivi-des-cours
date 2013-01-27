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
            $course = $this->getReference('course' . $c);
            for ($i = 1; $i <= 4; $i++) {
                $cs = new ClassSession();
                $cs->setCourse($course);
                
                $y = rand(2012,2013);
                $m = rand(01,12);
                $d = rand(01,30);
                $timestamp = strtotime($d.'-'.$m.'-'.$y);
                $cs->setDate(new \DateTime("@$timestamp"));
                
                $teachers = $course->getTeachers();
                
                $j = rand(1,4);
                $cs->setSessionTeacher($teachers[0]);
                $cs->setReportTeacher($teachers[0]);
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
