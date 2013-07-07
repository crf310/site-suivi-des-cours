<?php

namespace Virgule\Bundle\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DocumentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DocumentRepository extends EntityRepository {
    
    private function createDefaultQueryBuilder() {
        return $this->createQueryBuilder('d')->add('orderBy', 'd.fileName ASC');
    }
    
    public function getDocumentsUploadedBy($userId) {
        $qb = $this->createDefaultQueryBuilder()
            ->innerJoin('d.uploader', 'u', 'WITH', 'u.id = :userId')
            ->setParameter('userId', $userId);
        
        return $qb->getQuery()->execute();
    }
}
