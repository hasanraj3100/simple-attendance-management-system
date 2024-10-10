<?php
namespace ams\Controllers;

use DateTime;

class amsController {
    private $students;
    private $courseTable;
    private $semesterTable;
    private $departmentTable;
    private $absentTable;
    private $attendanceTable;

    private $authentication;

    public function __construct($students, $course, $semester, $department, $absent, $attendance, \Ninja\Authentication $authentication)
    {
        $this->students= $students;
        $this->courseTable= $course;
        $this->semesterTable= $semester;
        $this->departmentTable= $department;
        $this->absentTable= $absent;
        $this->attendanceTable= $attendance;
        $this->authentication= $authentication;
    }



    public function home() {
        if($this->authentication->isLoggedIn()) {
            header('Location: /ams');
        } else {
            return [
                'title'=> 'Login',
                'template'=> 'login.html.php'
            ];
        }
    }

    public function processLogin() {
        if($this->authentication->login($_POST['username'], $_POST['password'])) {
            header('Location: /ams');
        } else {
            return [
                'title'=>'Invalid username or password',
                'template'=> 'login.html.php',
                'variables'=> [
                    'error'=> 'Invalid username or password'
                ]
            ];
        }
        

    }

    public function mainpage() {

        if(isset($_GET['course']) or isset($_GET['semester']) or isset($_GET['department'])) {
            $allstudents=[];
            if(isset($_GET['course'])) {
                $items= $this->students->find('course_id',$_GET['course']);
                foreach($items as $item) {
                    $allstudents[]= $item;
                }
            } 
            
            if(isset($_GET['semester'])) {
                $items= $this->students->find('semester_id',$_GET['semester']);
                foreach($items as $item) {
                    $allstudents[]= $item;
                }
            } 
            
            if(isset($_GET['department'])) {
                $items= $this->students->find('department_id',$_GET['department']);
                foreach($items as $item) {
                    $allstudents[]= $item;
                }
            }

        } else {
            $allstudents= $this->students->findAll();

            $students=[];
        }
        $courses= $this->courseTable->findAll();
        $semesters= $this->semesterTable->findAll();
        $departments= $this->departmentTable->findAll(); 
        $attendance= $this->attendanceTable->find('date', new DateTime());
        
        $student_status=[];
        $attid=[];
        foreach($attendance as $item) {
            $attid[]= $item['student_id'];

            $student_status[$item['student_id']]=$item['status'];
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

        return [
            'title'=>'Attendance Management System',
            'template'=>'mainpage.html.php',
            'variables'=> [
                'course'=> $courses,
                'semester'=> $semesters,
                'department'=> $departments,
                'students'=> $students,
                'attendances' => $attendance,
                'attended'=> $attid ?? [],
                'student_status' => $student_status
            ]
            ];
    }

    public function addStudent() {
        $student= $_POST['student'];
        $this->students->insert($student);

        header('Location: /ams');

    }

    public function attendance() {
        $id= $_POST['id'];
        if(isset($_POST['absent'])) {
            $this->attendanceTable->insert(['student_id'=>$id, 'status'=>'absent', 'date'=> new DateTime()]);
            header('Location: /ams#table');
        }

        if(isset($_POST['present'])) {
            $this->attendanceTable->insert(['student_id'=>$id, 'status'=>'present', 'date'=> new DateTime()]);
            header('Location: /ams#table');
        }


    }

    public function ok() {
        return [
            'template'=>'success.html.php',
            'title'=> 'You neeed to login'
        ];
    }

    public function logout() {
        session_unset();
        return [
            'title'=> 'log out',
            'template'=> 'success.html.php'
        ];
    }

    

}