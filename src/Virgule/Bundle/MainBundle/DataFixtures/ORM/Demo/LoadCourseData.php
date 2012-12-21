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
        //$manager->persist($course1);
        //$manager->flush();
    }
    
    public function getOrder() {
        return 4;
    }
}

?>
