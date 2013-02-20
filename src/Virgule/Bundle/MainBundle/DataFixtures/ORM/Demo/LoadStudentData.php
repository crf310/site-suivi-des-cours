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

        $countryCodes = Array('af', 'za', 'ax', 'al', 'dz', 'de', 'ad', 'ao', 'ai', 
            'aq', 'ag', 'sa', 'ar', 'am', 'aw', 'au', 'at', 'az', 'bs', 'bh', 'bd', 
            'bb', 'by', 'be', 'bz', 'bj', 'bm', 'bt', 'bo', 'bq', 'ba', 'bw', 'bv', 
            'br', 'bn', 'bg', 'bf', 'bi', 'ky', 'kh', 'cm', 'ca', 'cv', 'cf', 'cl', 
            'cn', 'cx', 'cy', 'cc', 'co', 'km', 'cg', 'cd', 'ck', 'kr', 'kp', 'cr', 
            'ci', 'hr', 'cu', 'cw', 'dk', 'dj', 'do', 'dm', 'eg', 'sv', 'ae', 'ec', 
            'er', 'es', 'ee', 'us', 'et', 'fk', 'fo', 'fj', 'fi', 'fr', 'ga', 'gm', 
            'ge', 'gs', 'gh', 'gi', 'gr', 'gd', 'gl', 'gp', 'gu', 'gt', 'gg', 'gn', 
            'gw', 'gq', 'gy', 'gf', 'ht', 'hm', 'hn', 'hk', 'hu', 'im', 'um', 'vg', 
            'vi', 'in', 'id', 'ir', 'iq', 'ie', 'is', 'il', 'it', 'jm', 'jp', 'je', 
            'jo', 'kz', 'ke', 'kg', 'ki', 'kw', 'la', 'ls', 'lv', 'lb', 'lr', 'ly', 
            'li', 'lt', 'lu', 'mo', 'mk', 'mg', 'my', 'mw', 'mv', 'ml', 'mt', 'mp', 
            'ma', 'mh', 'mq', 'mu', 'mr', 'yt', 'mx', 'fm', 'md', 'mc', 'mn', 'me', 
            'ms', 'mz', 'mm', 'na', 'nr', 'np', 'ni', 'ne', 'ng', 'nu', 'nf', 'no', 
            'nc', 'nz', 'io', 'om', 'ug', 'uz', 'pk', 'pw', 'ps', 'pa', 'pg', 'py', 
            'nl', 'pe', 'ph', 'pn', 'pl', 'pf', 'pr', 'pt', 'qa', 're', 'ro', 'gb', 
            'ru', 'rw', 'eh', 'bl', 'sh', 'lc', 'kn', 'sm', 'mf', 'sx', 'pm', 'va', 
            'vc', 'sb', 'ws', 'as', 'st', 'sn', 'rs', 'sc', 'sl', 'sg', 'sk', 'si', 
            'so', 'sd', 'ss', 'lk', 'se', 'ch', 'sr', 'sj', 'sz', 'sy', 'tj', 'tw', 
            'tz', 'td', 'cz', 'tf', 'th', 'tl', 'tg', 'tk', 'to', 'tt', 'tn', 'tm', 
            'tc', 'tr', 'tv', 'ua', 'uy', 'vu', 've', 'vn', 'wf', 'ye', 'zm', 'zw');
        $genders = Array('F', 'M');
        $firstnames = Array('Jean', 'John', 'Juan', 'Xiao', 'Augustin', 'Dimitri', 'Sergiy', 'Ali', 'Abdel', 'Linus', 'Zinedine', 'Pol', 'Anas', 'Jean-Marc', 'Auguste', 'Zhen');
        $lastnames = Array('Dupont', 'Smith', 'Suarez', 'Lee', 'Ranaly', 'Serpov', 'Karabatic', 'Bongo', 'Serafi', 'Zidane', 'Bellaloui', 'Lopez', 'Eriksson', 'Torvalds', 'Larsson', 'Soualem');

        $nbFirstNames = count($firstnames) - 1;
        $nbLastNames = count($lastnames) - 1;
        $nbCountries = count($countryCodes) - 1;
        $nbCourses = 11;

        $commentContent = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";

        $nbStudents = 0;
        for ($i = 1; $i <= 234; $i++) {
            $s = new Student();
            $s->setFirstname($firstnames[rand(0, $nbFirstNames)]);
            $s->setLastname($lastnames[rand(0, $nbLastNames)]);
            $s->setGender($genders[rand(0, 1)]);

            $y = rand(1950, 1992);
            $m = rand(01, 12);
            $d = rand(01, 30);
            $timestamp = strtotime($d . '-' . $m . '-' . $y);
            $s->setBirthdate(new \DateTime("@$timestamp"));

            $rand = rand(0, $nbCountries);
            $rc = strtoupper($countryCodes[$rand]);
            $s->setNativeCountry($this->getReference('country-' . $rc));

            $s->setRegistrationDate(new \DateTime('now'));
            $s->setPhoneNumber("0102030405");
            $s->setCellphoneNumber("0607080910");

            $s->setWelcomedByTeacher($this->getReference('prof' . rand(1, 50)));

            $idCourse1 = rand(1, $nbCourses);
            $s->addCourse($this->getReference('course' . $idCourse1));
            if (rand(1, 5) % 5 == 0) {
                $idCourse2 = rand(1, $nbCourses);
                while ($idCourse1 == $idCourse2) {
                    $idCourse2 = rand(1, $nbCourses);
                }
                $s->addCourse($this->getReference('course' . $idCourse2));
            }

            $manager->persist($s);
            $this->addReference('student' . $nbStudents, $s);
            $nbStudents++;
        }
        $manager->flush();


        for ($i = 1; $i < $nbStudents; $i++) {
            if (rand(0, 1)) {
                for ($j = 1; $j <= rand(0, 2); $j++) {
                    $c = new Comment();
                    $c->setDate(new \DateTime('now'));
                    $c->setComment($commentContent);
                    $c->setTeacher($this->getReference('prof' . rand(1, 50)));
                    $c->setStudent($this->getReference('student' . $i));
                    $manager->persist($c);
                }
            }
        }
        $manager->flush();
    }

    public function getOrder() {
        return 15;
    }

}

?>
