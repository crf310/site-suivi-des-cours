<?php
namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Virgule\Bundle\MainBundle\Tests\Repository\AbstractRepositoryTest;

class ClassLevelRepositoryTest extends AbstractRepositoryTest {

    private function getRepository() {
        return $this->_em->getRepository('VirguleMainBundle:ClassLevel');
    }

    /**
     * @test
     */
    public function findAll_classLevelsExist_classLevelReturnedAndOrderedByPosition() {
        $results = $this->getRepository()->findAll();
        $this->assertEquals(3, count($results), "Expected 2 class levels");

        $previousPosition = -1;
        foreach ($results as $id => $classLevel) {
            $this->assertTrue($classLevel->getPosition() > $previousPosition);
            $this->assertEquals('Class level ' . ($id + 1), $classLevel->getLabel());
            $this->assertNotNull($classLevel->getHtmlColorCode());
            $previousPosition = $classLevel->getPosition();
        }
    }
}
?>
