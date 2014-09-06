<?php

namespace Virgule\Bundle\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ClassLevel
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClassLevelRepository extends EntityRepository {
    public function getDefaultQueryBuilder() {
        return $this->createQueryBuilder('cl')->add('orderBy', 'cl.position');
    }
    
    public function findAll() {
        $qb = $this->getDefaultQueryBuilder();
        return $qb->getQuery()->execute();
    }
}
