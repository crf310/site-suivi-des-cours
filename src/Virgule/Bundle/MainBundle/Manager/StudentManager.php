<?php
 
namespace Virgule\Bundle\MainBundle\Manager;
 
use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use Virgule\Bundle\MainBundle\Entity\Student;
 
class StudentManager extends BaseManager {
    
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getRepository() {
        return $this->em->getRepository('VirguleMainBundle:Student');
    }
    
    /**
     * Load all students enrolled in at least one class
     * @param type $semesterId
     * @return type
     */
    public function loadAllEnrolled($semesterId) {
        $students = $this->getRepository()->loadAllEnrolled($semesterId);
        return $this->mergeStudentLines($students);
    }
    
    /**
     * Load all students enrolled in more than one class
     * @param type $semesterId
     * @return type
     */
    public function loadAllEnrolledTwice($semesterId) {
        $students = $this->getRepository()->loadAllEnrolled($semesterId);
        $students_merged = $this->mergeStudentLines($students);
        return $this->removeStudentsWithOnlyWithEnrollment($students_merged['students_array'], $students_merged['courses_array']);
    }
    
    /**
     * Load all students not enrolled in any class of the current semester
     * @param type $semesterId
     * @return type
     */
    public function loadAllNotEnrolled($semesterId) {
        $courseRepository = $this->em->getRepository('VirguleMainBundle:Course');
        $coursesIds = $courseRepository->loadAllIdsForSemester($semesterId);
        
        $students = $this->getRepository()->loadNotEnrolledInCourses($coursesIds);
        
        return Array('students_array' => $students);
    }
    
    
    
    
    /**
     * Remove line in double (students with more than one course)
     * @param type $students
     */
    private function mergeStudentLines($students) {
        // array to keep students, with key == student_id
        $new_students = Array();
        // sub array to group students enrolled to many courses
        $students_ids = Array();
        $courses_array = Array();
        $i = 0;
        foreach ($students as $key => $student) {
            
            // store courses for each student
            $courses_array[$student['student_id']][] = Array('course_id' => $student['course_id'], 'level' => $student['level'], 'levelColorCode' => $student['levelColorCode']);
            
            // only keep the line if the students has not been processed already
            if (! array_key_exists($student['student_id'], $students_ids)) {
                 $new_students[$student['student_id']] = $student;
            }
            // set flag: we processed a line for this student
            $students_ids[$student['student_id']] = 1;
        }
        
        return array_merge(Array('students_array' => $new_students), Array('courses_array' => $courses_array));
    }
    
    private function removeStudentsWithOnlyWithEnrollment(Array $students, Array $students_courses) {
        foreach ($students_courses as $student_id => $courses) {
            if (count($courses) < 2) {
                unset($students[$student_id]);
            }
        }
        return array_merge(Array('students_array' => $students), Array('courses_array' => $students_courses));
    }
}

?>