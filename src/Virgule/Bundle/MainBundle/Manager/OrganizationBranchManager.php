<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\OrganizationBranch;

class OrganizationBranchManager extends BaseManager {

  protected $em;

  public function __construct(EntityManager $em) {
    $this->em = $em;
  }

  public function getRepository() {
    return $this->em->getRepository('VirguleMainBundle:OrganizationBranch');
  }

}

?>
