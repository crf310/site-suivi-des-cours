<?php

namespace Virgule\Bundle\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
/**
 * ClassRoomRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClassRoomRepository extends EntityRepository {

    private function createDefaultQueryBuilder() {
        return $this->createQueryBuilder('cr')->add('orderBy', 'cr.id');
    }

    public function getClassRoomsForOrganizationBranchQueryBuilder($organizationBranchId) {
        $qb = $this->createDefaultQueryBuilder()
                ->innerJoin('cr.organizationBranch' , 'ob')
                ->orderBy('cr.name')
                ->where('ob.id = :organizationBranchId')
                ->setParameter('organizationBranchId', $organizationBranchId);
        $id = $organizationBranchId;
        return $qb;
    }

    public function getClassRoomsForOrganizationBranch($organizationBranchId) {
        $qb = $this->getClassRoomsForOrganizationBranchQueryBuilder($organizationBranchId);
        $qb->select('cr.id as classroom_id, cr.name as classroom_name, cr.address as classroom_address, cr.comments as classroom_comments, ob.id as classroom_organization_branch');
        $q = $qb->getQuery();
        $students = $q->execute(array(), Query::HYDRATE_ARRAY);
        return $students;
    }
}
