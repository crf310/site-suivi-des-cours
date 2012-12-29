<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Student;

/**
 * Description of LoadStudentData
 *
 * @author Guillaume Lucazeau
 */
class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $countryCodes = Array('cn', '');
        $gender = Array('F','M');
        
        for ($i = 0; $i <= 100; $i++) {
            $s = new Student();
            $s->setFirstname("Augustin");
            $s->setLastName("Ranaly");
            $s->setGender("F");
            $s->setNativeCountry($this->getReference('country-MG'));
            $s->setRegistrationDate(new \DateTime('now'));
            $s->setPhoneNumber("0102030405");
            $s->setCellphoneNumber("0607080910");
            $manager->persist($s);
        }

        $manager->flush();
    }

    public function getOrder() {
        return 13;
    }

}

?>
