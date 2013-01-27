<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Student;
use Virgule\Bundle\MainBundle\Entity\Comment;

/**
 * Description of LoadStudentData
 *
 * @author Guillaume Lucazeau
 */
class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $countryCodes = Array('cn', 'ma', 'us', 'kr', 'mg', 'co', 'ua', 'uy', 'ru', 'sn', 'fr', 'zm', 'gb', 'tg', 'ug', 'me');
        $genders = Array('F', 'M');
        $firstnames = Array('Jean', 'John', 'Juan', 'Xiao', 'Augustin', 'Dimitri', 'Sergiy', 'Ali', 'Abdel');
        $lastnames = Array('Dupont', 'Smith', 'Suarez', 'Lee', 'Ranaly', 'Serpov', 'Karabatic', 'Bongo', 'Serafi');

        $nbFirstNames = count($firstnames) - 1;
        $nbLastNames = count($lastnames) - 1;
        $nbCountries = count($countryCodes) - 1;
        $nbCourses = 4;

        $commentContent = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";

        $nbStudents = 0;
        for ($i = 1; $i <= 55; $i++) {
            $s = new Student();
            $s->setFirstname($firstnames[rand(0, $nbFirstNames)]);
            $s->setLastname($lastnames[rand(0, $nbLastNames)]);
            $s->setGender($genders[rand(0, 1)]);

            $rand = rand(0, $nbCountries);
            $rc = strtoupper($countryCodes[$rand]);
            $s->setNativeCountry($this->getReference('country-' . $rc));

            $s->setRegistrationDate(new \DateTime('now'));
            $s->setPhoneNumber("0102030405");
            $s->setCellphoneNumber("0607080910");

            $s->setWelcomedByTeacher($this->getReference('prof' . rand(1, 50)));

            $s->addCourse($this->getReference('course' . rand(1, $nbCourses)));

            $manager->persist($s);
            $this->addReference('student' . $nbStudents, $s);
            $nbStudents++;
        }
        $manager->flush();


        for ($i = 1; $i < $nbStudents; $i++) {
            for ($j = 1; $j <= rand(1, 3); $j++) {
                $c = new Comment();
                $c->setDate(new \DateTime('now'));
                $c->setComment($commentContent);
                $c->setTeacher($this->getReference('prof' . rand(1, 50)));
                $c->setStudent($this->getReference('student'.$i));
                $manager->persist($c);
            }
        }
        $manager->flush();
    }

    public function getOrder() {
        return 15;
    }

}

?>
