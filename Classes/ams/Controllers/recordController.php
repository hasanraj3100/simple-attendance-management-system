<?php
namespace ams\Controllers;

class recordController {
    private $attendanceTable;
    private $students;
    private $semesterTable;
    private $courseTable;
    private $departmentTable;

    public function __construct(\Ninja\DatabaseTable $attendanceTable, \Ninja\DatabaseTable $stuTable, $course, $semester, $depa) 
    {
        $this->attendanceTable= $attendanceTable;
        $this->students= $stuTable;
        $this->courseTable= $course;
        $this->semesterTable= $semester;
        $this->departmentTable= $depa;
    }


    public function getDates() {
        $dates= $this->attendanceTable->distinctValue('date');

        return [
            'title'=> 'All records',
            'template'=> 'dates.html.php',
            'variables'=> [
                'dates'=> $dates,
                'data'=> $dates
                ]
        ];
    }

    public function records() {
        $date= $_GET['date'];

        $attendance= $this->attendanceTable->find('date', $date);  
        
        $student_status=[];
        $allstudents=[];
        $totalPresent= 0;
        $totalAbsent= 0;

        if(!empty($attendance)) {
            foreach($attendance as $item) {
                $allstudents[]=$this->students->findById($item['student_id']);

                $student_status[$item['student_id']]=$item['status'];

                if($item['status']=='present') {
                $totalPresent++;
                } else {$totalAbsent++;}
            }


            foreach($allstudents as $student) {
                $id= $student['id'];
                $roll= $student['roll_no'];
                $name= $student['name'];
                $course= $this->courseTable->findById($student['course_id']);
                $semester= $this->semesterTable->findById($student['semester_id']);
                $department= $this->departmentTable->findById($student['department_id']);

                $students[]= [
                    'id'=> $id,
                    'roll'=> $roll,
                    'name'=> $name,
                    'course'=> $course['name'],
                    'semester'=> $semester['name'],
                    'department'=> $department['name'],
                
                ];

            }
        }
    


        return [
            'title'=>'Record for ' . $date,
            'template'=>'records.html.php',
            'variables'=> [
                'students'=> $students ?? [],
                'student_status' => $student_status ?? '',
                'presentCount' => $totalPresent ?? '',
                'absentCount' => $totalAbsent ?? ''
            ]
            ];
    }
}