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
In convallis, lacus a dapibus accumsan, sapien mauris ornare risus, sit amet dignissim lorem magna at augue. Sed vulputate dapibus ornare. Cras ultrices urna et enim accumsan gravida. In hac habitasse platea dictumst. Nullam posuere, urna et condimentum fringilla, libero dolor interdum dui, non cursus nibh lorem vitae sapien. Maecenas mauris ipsum, tincidunt et auctor a, venenatis at sapien. Sed placerat lacinia est eu varius. Duis blandit elit vel nibh volutpat aliquam. Sed erat augue, volutpat ut elementum vel, porttitor quis arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et ipsum et mauris varius pretium.";

        $commentContent = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore";

        $nbClassSessions = 0;
        
        $nbStudents = 234;
        
        $nbCourses = 12;
        
        for ($c = 1; $c <= $nbCourses; $c++) {
            $course = $this->getReference('course' . $c);
            for ($i = 1; $i <= rand(15,25); $i++) {
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
                $nbStudentsEnrolled = count($course->getStudents());
                $students = $course->getStudents();
                for ($nbStudents = 1; $nbStudents <= rand(5,$nbStudentsEnrolled); $nbStudents++) {
                    do {
                        $studentId = rand(0, $nbStudentsEnrolled-1);
                        $student = $students->get($studentId);
                    } while (in_array($student->getId(), $studentAlreadyAdded));
                    
                    $cs->addClassSessionStudent($student);
                    $studentAlreadyAdded[] = $student->getId();
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
