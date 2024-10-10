<?php
namespace ams\Controllers;

class studentController {
    private $students;
    private $courseTable;
    private $semesterTable;
    private $departmentTable;
    private $absentTable;
    private $attendanceTable;

    private $authentication;

    public function __construct(\Ninja\DatabaseTable $students, $course, $semester, $department, $absent, $attendance )
    {
        $this->students= $students;
        $this->courseTable= $course;
        $this->semesterTable= $semester;
        $this->departmentTable= $department;
        $this->absentTable= $absent;
        $this->attendanceTable= $attendance;
    }

    public function profile() {
        $id= $_GET['id'];

        $student= $this->students->findById($id);
        $department= $this->departmentTable->findById($student['department_id']);
        $semester= $this->semesterTable->findById($student['semester_id']);
        $course= $this->courseTable->findById($student['course_id']);
        $attendance= $this->attendanceTable->find('student_id',$id);
        
        $totalPresent=0;
        $totalAbsent=0;
        foreach($attendance as $i) {
            if($i['status']=='present') {
                $totalPresent++;
            } else {
                $totalAbsent++;
            }
        }

        $percentage= ($totalPresent/($totalPresent+$totalAbsent)) * 100;
 

        return [
            'template' => 'profile.html.php',
            'title' => 'Rohim',
            'variables' => [
                'name' => $student['name'],
                'roll' => $student['roll_no'],
                'department'=> $department['name'],
                'course'=> $course['name'],
                'semester'=> $semester['name'],
                'attendances'=> $attendance ?? [],
                'totalP'=> $totalPresent,
                'totalA'=> $totalAbsent,
                'rate' => number_format($percentage,2)
            ]
        ] ;
    }
}