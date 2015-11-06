<?php
namespace Virgule\Bundle\MainBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Virgule\Bundle\MainBundle\Manager\BaseManager;

class HelpManager extends BaseManager {

    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
}

?>
