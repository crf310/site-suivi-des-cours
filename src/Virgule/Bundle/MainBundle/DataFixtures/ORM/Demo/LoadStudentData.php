<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Student;
use Virgule\Bundle\MainBundle\Entity\Comment;
use Virgule\Bundle\MainBundle\Entity\ClassLevelSuggested;

/**
 * Description of LoadStudentData
 *
 * @author Guillaume Lucazeau
 */
class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $fakerFr = \Faker\Factory::create('fr_FR');
        
        
        $countryCodes = Array('af','za','al','dz','ao','am','at','az','bd','by','bj','bt','bo','br','bg','kh','cm','cv','cl','cn','co',
                            'km','cg','cd','kr','ci','hr','do','eg','ae','ec','er','es','et','fr','ge','gt','gn','ht','hk','in',
                            'id','ir','iq','il','it','jm','jp','kz','ke','kg','lv','lb','lr','mk','ml','ma','mu','mr','md','mn','mm',
                            'np','ne','ng','uz','pk','ps','pe','ph','pl','pt','ro','ru','rw','sn','rs','sl','sk','sd','lk','se','sy',
                            'cz','th','tn','tr','ua','ve','vn','mg','cn-54');
        
        $locales = Array('cs_CZ', 'en_PH', 'lv_LV', 'de_DE', 'da_DK', 'ja_JP', 'uk_UA', 'de_AT', 'sr_Cyrl_RS', 'bg_BG', 'pt_BR', 'ru_RU', 'sk_SK', 'en_ZA', 'en_US', 'el_GR', 'hy_AM', 'ro_RO', 'is_IS', 'es_PE', 'nl_NL', 'sr_Latn_RS', 'it_IT', 'ro_MD', 'nl_BE', 'fr_FR', 'en_CA', 'pl_PL', 'fi_FI', 'sr_RS', 'en_GB', 'fr_BE', 'en_AU', 'es_AR', 'tr_TR', 'zh_CN', 'es_ES');
        $nbLocales = count($locales);
        
        $genders = Array('F', 'M');
        $nbCourses = 12;

        $classLevels = Array('A1', 'A2', 'B1/1', 'B1/2', 'B2', 'B3');
        
        $commentContent = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";

        $nbStudents = 0;
        for ($i = 1; $i <= 234; $i++) {
            $locale = $locales[rand(0, $nbLocales-1)];            
            $faker = \Faker\Factory::create($locale);
            
            $s = new Student();
            
            $gender = $genders[rand(0, 1)];
            $s->setGender($gender);
            
            if ($gender == 'F') {
                if (isset($faker->firstNameFemale)) {
                    $fname = $faker->firstNameFemale;
                } else {
                    $fname = $faker->firstName;
                }
            } else {
                if (isset($faker->firstNameMale)) {
                    $fname = $faker->firstNameMale;
                } else {
                    $fname = $faker->firstName;
                }         
            }
            $s->setFirstname($fname);
            $s->setLastname($faker->lastName);

            if (rand(1,50) < 25) {
                $s->setPath('jpg');
            }
            
            $y = rand(1950, 1992);
            $m = rand(01, 12);
            $d = rand(01, 30);
            $timestamp = strtotime($d . '-' . $m . '-' . $y);
            $s->setBirthdate(new \DateTime("@$timestamp"));

            if (in_array(substr($locale, 0, 2), $countryCodes)) {
                $s->setNativeCountry(substr($locale, 0, 2));
            } else {
                $s->setNativeCountry($countryCodes[rand(0, count($countryCodes)-1)]);
            }
            
            $y = rand(2010, 2012);
            $m = rand(01, 12);
            $d = rand(01, 30);
            $timestamp = strtotime($d . '-' . $m . '-' . $y);
            $s->setRegistrationDate(new \DateTime('now'));
            
            $s->setPhoneNumber('0102030405');
            $s->setCellphoneNumber('0605040302');
            $s->setAddress($fakerFr->streetAddress);
            $s->setZipcode($fakerFr->postcode);
            $s->setCity($fakerFr->city);

            $s->setWelcomedByTeacher($this->getReference('prof' . rand(1, 50)));
            $s->setWelcomedInOrganizationBranch($this->getReference('deleg-3-10'));

            $s->setEmergencyContactFirstname("Chuck");
            $s->setEmergencyContactLastname("Norris");
            $s->setEmergencyContactPhoneNumber("5554443332");
            $s->setEmergencyContactConnectionType("Texas Ranger");
            
            $languagesAdded = Array();
            for ($sl = 1; $sl <= rand(1,3); $sl++) {
                do {
                    $rsl = rand(0, 216);
                } while (in_array($rsl, $languagesAdded));                
                $s->addSpokenLanguage($this->getReference('language-' . $rsl));
                $languagesAdded[] = $rsl;
            }
                        
            if (rand(1, 10) != 1) {
                $idCourse1 = rand(1, $nbCourses);
                $s->addCourse($this->getReference('course' . $idCourse1));
                if (rand(1, 5) % 5 == 0) {
                    $idCourse2 = rand(1, $nbCourses);
                    while ($idCourse1 == $idCourse2) {
                        $idCourse2 = rand(1, $nbCourses);
                    }
                    $s->addCourse($this->getReference('course' . $idCourse2));
                } 
                if (rand(1, 5) % 5 == 0) {
                    $idCourse3 = rand(1, $nbCourses);
                    while ($idCourse3 == $idCourse1 || $idCourse3 == $idCourse2) {
                        $idCourse3 = rand(1, $nbCourses);
                    }
                    $s->addCourse($this->getReference('course' . $idCourse3));
                }
            }
                        
            $manager->persist($s);
            $this->addReference('student-' . $nbStudents, $s);
            $nbStudents++;
        }
        $manager->flush();


        for ($i = 1; $i < $nbStudents; $i++) {
            if (rand(0, 1)) {
                for ($j = 1; $j <= rand(0, 2); $j++) {
                    $c = new Comment();
                    $y = rand(2012, 2012);
                    $m = rand(01, 12);
                    $d = rand(01, 30);
                    $timestamp = strtotime($d . '-' . $m . '-' . $y);
                    $c->setDate(new \DateTime("@$timestamp"));
                    $c->setComment($commentContent);
                    $c->setTeacher($this->getReference('prof' . rand(1, 50)));
                    $c->setStudent($this->getReference('student-' . $i));
                    $manager->persist($c);
                }
            }
            
            // history of suggested class levels
            $cls = new ClassLevelSuggested();
            $cls->setClassLevel();
            $y = rand(2010, 2012);
            $m = rand(01, 12);
            $d = rand(01, 30);
            $timestamp = strtotime($d . '-' . $m . '-' . $y);
            $cls->setDateOfChange(new \DateTime("@$timestamp"));
            $cls->setChanger($this->getReference('prof' . rand(1, 50)));
            $cls->setClassLevel($this->getReference($classLevels[rand(0, count($classLevels)-1)]));
            $cls->setStudent($this->getReference('student-' . $i));
            $manager->persist($cls);
            
            $cls1 = new ClassLevelSuggested();
            $cls1->setClassLevel();
            $cls1->setDateOfChange(new \DateTime("now"));
            $cls1->setChanger($this->getReference('prof' . rand(1, 50)));
            $cls1->setClassLevel($this->getReference($classLevels[rand(0, count($classLevels)-1)]));
            $cls1->setStudent($this->getReference('student-' . $i));
            $manager->persist($cls1);
        }
        $manager->flush();
    }

    public function getOrder() {
        return 15;
    }

}

?>
