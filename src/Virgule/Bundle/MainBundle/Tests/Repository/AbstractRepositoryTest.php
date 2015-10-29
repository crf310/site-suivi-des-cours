<?php
namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractRepositoryTest extends WebTestCase {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;

    public function setUp() {
        $kernel = static::createKernel(Array('environment' => 'test'));
        $kernel->boot();
        $this->_em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

}
?>
