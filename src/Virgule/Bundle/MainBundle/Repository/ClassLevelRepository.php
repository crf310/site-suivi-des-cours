<?php

namespace Virgule\Bundle\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ClassLevelRepository
 */
class ClassLevelRepository extends EntityRepository {

    public function findAll() {
      return $this->findBy(array(), array('position' => 'ASC'));
    }
}
