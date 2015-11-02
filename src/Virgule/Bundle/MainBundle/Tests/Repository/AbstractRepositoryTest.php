<?php

namespace Virgule\Bundle\MainBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Bundle\FrameworkBundle\Console\Application;

abstract class AbstractRepositoryTest extends WebTestCase {

  /**
   * @var \Doctrine\ORM\EntityManager
   */
  protected $_em;

  protected static $application;

  /**
   * @beforeClass
   */
  public function setUp() {
    $kernel = static::createKernel(Array('environment' => 'test'));
    $kernel->boot();
    $this->_em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    
    self::runCommand('doctrine:fixtures:load --no-interaction --env=test --fixtures=src/Virgule/Bundle/MainBundle/DataFixtures/ORM/App --fixtures=src/Virgule/Bundle/MainBundle/DataFixtures/ORM/Test');
  }

  protected static function runCommand($pCommand) {
    $command = sprintf('%s --quiet', $pCommand);

    return self::getApplication()->run(new StringInput($command));
  }

  protected static function getApplication() {
    if (null === self::$application) {
      $kernel = static::createKernel(Array('environment' => 'test')); 
      self::$application = new Application($kernel);
      self::$application->setAutoExit(false);
    }

    return self::$application;
  }

}

?>
