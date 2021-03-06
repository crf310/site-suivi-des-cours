<?php

namespace Virgule\Bundle\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * OrganizationBranchRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrganizationBranchRepository extends EntityRepository {

  public function loadOne($id) {
    $og = $this->findOneBy(array('id' => $id));
    if ($og == null) {
      throw new NoResultException("Can't find the Organization Branch");
    } else {
      return $og;
    }
  }

}

?>
