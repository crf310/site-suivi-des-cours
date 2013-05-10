<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\ClassSession;
use Virgule\Bundle\MainBundle\Entity\Comment;

/**
 * Description of LoadCourseData
 *
 * @author Guillaume Lucazeau
 */
class LoadClassSessionData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $summary = "

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vestibulum ultrices ullamcorper. Vestibulum vitae magna purus, tristique euismod lectus. Nunc in nunc quis risus luctus consectetur at eu velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis adipiscing diam non tellus adipiscing blandit. Morbi mollis nunc ultrices libero vestibulum sit amet faucibus quam vulputate. Pellentesque a pulvinar risus. Aenean sem ligula, tempor vel tincidunt ut, mollis a nisi. Aliquam suscipit, dui sit amet dapibus mattis, arcu risus dapibus odio, ut consequat augue felis condimentum erat. In congue elit nec sem scelerisque sagittis. Ut malesuada magna eget massa accumsan lobortis. Phasellus dui purus, tempor eget dignissim eget, <b>fringilla</b> et <b>tellus</b>. Vestibulum vestibulum sapien id libero elementum vestibulum. Sed dictum porttitor enim a gravida. Sed aliquet arcu eget mauris hendrerit molestie. Aliquam erat volutpat.<br />
<br />
In convallis, lacus a dapibus accumsan, sapien mauris ornare risus, sit amet dignissim lorem magna at augue. Sed vulputate dapibus ornare. Cras ultrices urna et enim accumsan gravida. In hac habitasse platea dictumst. Nullam posuere, urna et condimentum fringilla, libero dolor interdum dui, non cursus nibh lorem vitae sapien. Maecenas mauris ipsum, tincidunt et auctor a, venenatis at sapien. Sed placerat lacinia est eu varius. Duis blandit elit vel nibh volutpat aliquam. Sed erat augue, volutpat ut elementum vel, porttitor quis arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et ipsum et mauris varius pretium.<br />
<br />
Morbi lectus turpis, gravida eu rhoncus eu, dictum at orci. Sed auctor nulla vitae nulla suscipit at porttitor erat egestas. <u>Vestibulum justo massa</u>, porta a sollicitudin non, suscipit vitae turpis. Nullam at facilisis dui. Aenean vitae ante ligula, a luctus leo. In id erat diam, sed aliquam lacus. Cras leo justo, blandit vel vulputate et, ultricies eget quam. Quisque vehicula pellentesque tortor, eget vestibulum est fringilla eu. Aenean erat lorem, accumsan hendrerit iaculis ac, imperdiet nec nibh. Sed bibendum, mi ut tempus euismod, est orci tempus leo, et tincidunt nisi turpis quis leo. Pellentesque luctus massa in metus tempus pharetra. Ut massa sapien, eleifend at tempor viverra, tempus ac nunc. Mauris sit amet metus eget est pretium dapibus at id nisi. ";

        $commentContent = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore";

        $nbClassSessions = 0;
        
        $nbStudents = 234;
        
        $nbCourses = 12;
        
        for ($c = 1; $c <= $nbCourses; $c++) {
            $course = $this->getReference('course' . $c);
            for ($i = 1; $i <= rand(5,15); $i++) {
                $cs = new ClassSession();
                $cs->setCourse($course);

                $y = rand(2011, 2012);
                $m = rand(01, 12);
                $d = rand(01, 30);
                $timestamp = strtotime($d . '-' . $m . '-' . $y);
                $cs->setSessionDate(new \DateTime("@$timestamp"));
                $cs->setReportDate(new \DateTime("@$timestamp"));

                $teachers = $course->getTeachers();
                $cs->setSessionTeacher($teachers[0]);
                $cs->setReportTeacher($teachers[0]);
                $cs->setSummary($summary);

                $studentAlreadyAdded = Array();
                for ($nbStudents = 1; $nbStudents <= rand(5,25); $nbStudents++) {
                    do {
                        $studentRef = 'student-' . rand(1, $nbStudents);
                    } while (in_array($studentRef, $studentAlreadyAdded));
                    
                    $cs->addClassSessionStudent($this->getReference($studentRef));
                    $studentAlreadyAdded[] = $studentRef;
                }
                $manager->persist($cs);
                $nbClassSessions++;
                $this->addReference('classsession' . $nbClassSessions, $cs);
            }
        }
        $manager->flush();

        // comments
        for ($i = 1; $i <= $nbClassSessions; $i++) {
            if (rand(0, 1)) {
                for ($j = 1; $j <= rand(0, 3); $j++) {
                    $comment = new Comment();
                    $y = rand(2012, 2013);
                    $m = rand(01, 12);
                    $d = rand(01, 30);
                    $timestamp = strtotime($d . '-' . $m . '-' . $y);
                    $comment->setDate(new \DateTime("@$timestamp"));
                    $comment->setComment($commentContent);
                    $comment->setTeacher($this->getReference('prof' . rand(1, 4)));
                    $comment->setClassSession($this->getReference('classsession' . $i));
                    $manager->persist($comment);
                }
            }
        }
        $manager->flush();
    }

    public function getOrder() {
        return 16;
    }

}

?>
