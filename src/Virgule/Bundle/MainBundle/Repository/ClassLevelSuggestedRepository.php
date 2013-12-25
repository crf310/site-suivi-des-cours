<?php

namespace Virgule\Bundle\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\DBAL\Connection;

/**
 * ClassLevel
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClassLevelSuggestedRepository extends EntityRepository {
    
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createDefaultQueryBuilder() {
        return $this->createQueryBuilder('cls');
    }
    
    public function getClassLevelsHistoryPerStudent($studentId) {
        $qb = $this->createDefaultQueryBuilder()
                ->addSelect('cls.dateOfChange as dateOfChange')
                ->addselect('t.id as teacher_id, t.firstName as teacher_firstName, t.lastName as teacher_lastName')
                ->addSelect('cl.label as classLevelLabel, cl.htmlColorCode as classLevelColorCode')
                ->innerJoin('cls.classLevel', 'cl')
                ->innerJoin('cls.student', 's')
                ->innerJoin('cls.changer', 't')
                ->where('s.id = :studentId')
                ->orderBy('cls.dateOfChange', 'DESC')
                ->setParameter('studentId', $studentId);
        
        $q = $qb->getQuery();
        $classLevels = $q->execute(array(), Query::HYDRATE_ARRAY);
        return $classLevels;
    }
    
    public function getCurrentClassLevelSuggested($studentId) {
        $qb = $this->createDefaultQueryBuilder()
                ->innerJoin('cls.student', 's')
                ->where('s.id = :studentId')
                ->orderBy('cls.dateOfChange', 'DESC')
                ->setParameter('studentId', $studentId);
        
        $q = $qb->getQuery();
        return $q->execute()->getOneOrNullResult();
    }
}
