<?php

namespace Virgule\Bundle\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Connection;

/**
 * ClassLevel
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CourseRepository extends EntityRepository {

    /**
     * Count number of courses that overlap
     * $another_meeting = ($from >= $from_compare && $from <= $to_compare) || ($from_compare >= $from && $from_compare <= $to);
     * @param type $semesterId
     * @param type $dayOfWeek
     * @param type $classRoomId
     * @param type $startTime
     * @param type $endTime
     * @return type Integer
     */
    public function getNumberOfOverlappingCourses($semesterId, $dayOfWeek, $classRoomId, $startTime, $endTime) {
        $q = $this
                ->createQueryBuilder('c')
                ->select('count(c.id) as nb_courses')
                ->innerJoin('c.semester', 's')                
                ->innerJoin('c.classRoom', 'c2')
                ->where('s.id = :semesterId')
                ->andWhere('c.dayOfWeek = :dayOfWeek')
                ->andWhere('c2.id = :classRoomId')
                ->andWhere('(c.startTime > :startTime AND c.startTime < :endTime) 
                    OR (:startTime > c.startTime AND :startTime < c.endTime)
                    OR (:startTime = c.startTime AND :endTime = c.endTime)'
                )
                ->setParameter('semesterId', $semesterId)
                ->setParameter('dayOfWeek', $dayOfWeek)
                ->setParameter('classRoomId', $classRoomId)
                ->setParameter('startTime', $startTime, Type::TIME)
                ->setParameter('endTime', $endTime, Type::TIME)
                ->getQuery()
        ;
        $nb = $q->getSingleResult();
        return $nb;
    }

    public function getCoursesByTeacher($semesterId, $teacherId) {
        $q = $this
                ->createQueryBuilder('c')
                ->innerJoin('c.teachers', 't')
                ->innerJoin('c.semester', 's')
                ->where('s.id = :semesterId')
                ->andWhere('t.id = :teacherId')
                ->add('orderBy', 'c.dayOfWeek ASC, c.startTime ASC')
                ->setParameter('teacherId', $teacherId)
                ->setParameter('semesterId', $semesterId)
                ->getQuery()
        ;
        $nb = $q->execute();
        return $nb;
    }

    public function getCoursesByStudent($studentId) {
        $q = $this->getCoursesByStudentQuery($studentId);
        $results = $q->execute();
        return $results;
    }

    public function getCoursesByStudentAndSemester($studentId, $semesterId) {
        $q = $this->getCoursesByStudentQuery($studentId)
                ->andWhere('s2.id = :semesterId')
                ->setParameter('semesterId', $semesterId)
                ->getQuery()
        ;
        $results = $q->execute();
        return $results;
    }

    private function getCoursesByStudentQuery($studentId) {
        $q = $this
                ->createQueryBuilder('c')
                ->innerJoin('c.students', 's')
                ->innerJoin('c.semester', 's2')
                ->where('s.id = :studentId')
                ->add('orderBy', 's2.startDate DESC, c.dayOfWeek ASC, c.startTime ASC')
                ->setParameter('studentId', $studentId)
                ->getQuery()
        ;
        return $q;
    }

    public function loadAll($semesterId) {
        $q = $this
                ->createQueryBuilder('c')
                ->addSelect('c.id as course_id, c.dayOfWeek, c.startTime, c.endTime, c.alternateStartdate, c.alternateEnddate')
                ->addSelect('r.id as classroom_id, r.name as classroom_name')
                ->addSelect('c2.id as classlevel_id, c2.label as classlevel_name, c2.htmlColorCode as classlevel_colorcode')
                ->addSelect('t.id as teacher_id, t.lastName as teacher_lastName, t.firstName as teacher_firstName')
                ->addSelect('count(stu.id) as nb_students')
                ->innerJoin('c.teachers', 't')
                ->innerJoin('c.classLevel', 'c2')
                ->innerJoin('c.classRoom', 'r')
                ->innerJoin('c.semester', 's')
                ->leftJoin('c.students', 'stu')
                ->where('s.id = :semesterId')
                ->groupBy('c.id, t.id')
                ->add('orderBy', 'c.dayOfWeek ASC, c.startTime ASC')
                ->setParameter('semesterId', $semesterId)
                ->getQuery()
        ;
        $results = $q->execute(array(), Query::HYDRATE_ARRAY);

        return $results;
    }
    
    public function loadAllIdsForSemester($semesterId) {
        $q = $this
                ->createQueryBuilder('c')
                ->addSelect('c.id as course_id')
                ->innerJoin('c.semester', 's')
                ->where('s.id = :semesterId')
                ->setParameter('semesterId', $semesterId)
                ->getQuery()
        ;
        $results = $q->execute(array(), Query::HYDRATE_ARRAY);

        return $results;
    }
    
    
    public function loadAllObjects($semesterId) {
        $q = $this
                ->createQueryBuilder('c')
                ->innerJoin('c.teachers', 't')
                ->innerJoin('c.classLevel', 'c2')
                ->innerJoin('c.classRoom', 'r')
                ->innerJoin('c.semester', 's')
                ->leftJoin('c.students', 'stu')
                ->where('s.id = :semesterId')
                ->groupBy('c.id')
                ->add('orderBy', 'c.dayOfWeek ASC, c.startTime ASC')
                ->setParameter('semesterId', $semesterId)
                ->getQuery()
        ;
        $results = $q->execute(array());
        return $results;
    }
    
    public function getCoursesForSemesterQB($semesterId) {
        $qb = $this
                ->createQueryBuilder('c')
                ->innerJoin('c.classLevel', 'c2')
                ->innerJoin('c.semester', 's')
                ->where('s.id = :semesterId')
                ->groupBy('c.id')
                ->add('orderBy', 'c.dayOfWeek ASC, c.startTime ASC')
                ->setParameter('semesterId', $semesterId)
        ;
        return $qb;
    }
    
    public function findByIds(array $coursesIds) {
        $q = $this
                ->createQueryBuilder('c')         
                ->innerJoin('c.teachers', 't')       
                ->where('c.id IN (:coursesIds)')
                ->setParameter('coursesIds', $coursesIds, Connection::PARAM_INT_ARRAY)
                ->getQuery();
        return $q->execute();        
    }

    
    public function getCourseWithOldReports() {
        $q = $this
                ->createQueryBuilder('c')         
                ->innerJoin('c.semester', 's')       
                ->innerJoin('c.classSessions', 'cs')   
                ->where('cs.sessionDate < s.startDate')
                ->getQuery();
        return $q->execute();
    }
}
