<?php

namespace Virgule\Bundle\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ClassLevelRepository
 */
class ClassLevelRepository extends EntityRepository {

  public function getDefaultQueryBuilder() {
    return $this->createQueryBuilder('cl')->add('orderBy', 'cl.position');
  }

  public function findAll() {
    return $this->findBy(array(), array('position' => 'ASC'));
  }
}
