<?php
namespace ams;

use Ninja\DatabaseTable;

class amsRoutes implements \Ninja\Routes{
    private $courseTable;
    private $semesterTable;
    private $departmentTable;
    private $absentTable;
    private $holidayTable;
    private $students;
    private $authentication;
    private $adminTable;
    private $attendanceTable;


    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->courseTable= new DatabaseTable($pdo,'courses','id');
        $this->semesterTable= new DatabaseTable($pdo,'semesters','id');
        $this->departmentTable= new DatabaseTable($pdo, 'departments', 'id');
        $this->absentTable= new DatabaseTable($pdo,'absents','id');
        // $this->holidayTable= new DatabaseTable($pdo,'holidays','id');
        $this->students= new DatabaseTable($pdo,'students','id');
        $this->adminTable= new DatabaseTable($pdo,'admins','id');
        $this->attendanceTable= new DatabaseTable($pdo,'attendance','id');
        $this->authentication= new \Ninja\Authentication($this->adminTable, 'username', 'password');
        

    }


   public function getRoutes(): array {
        $amscontroller= new \ams\Controllers\amsController($this->students, $this->courseTable, $this->semesterTable,$this->departmentTable,$this->absentTable,$this->attendanceTable, $this->authentication);
        $recordController=new \ams\Controllers\recordController($this->attendanceTable, $this->students, $this->courseTable, $this->semesterTable, $this->departmentTable);
        $studentController= new \ams\Controllers\studentController($this->students, $this->courseTable, $this->semesterTable,$this->departmentTable,$this->absentTable,$this->attendanceTable);
        $courseController = new \ams\Controllers\courseController($this->courseTable);
        $semesterController = new \ams\Controllers\semesterController($this->semesterTable);
        $departmentController = new \ams\Controllers\departmentController($this->departmentTable);


        $routes= [
            '' => [
                'GET' => [
                    'controller'=> $amscontroller,
                    'action'=> 'home'
                ],
                'POST' => [
                    'controller'=> $amscontroller,
                    'action'=> 'processLogin'
                ]
                ],
            'ams'=> [
                'GET' => [
                    'controller'=> $amscontroller,
                    'action'=> 'mainpage'
                ] ,

                'POST' => [
                    'controller'=> $amscontroller,
                    'action'=> 'addStudent'
                ] ,
                'login'=>true
            ] ,

            'error'=> [
                'GET'=> [
                    'controller'=> $amscontroller,
                    'action'=> 'ok'
                ]
            ] ,
            'success' => [
                'GET'=> [
                    'controller' => $amscontroller,
                    'action'=> 'ok'
                ]

            ] ,

            'logout'=> [
                'GET' => [
                    'controller'=> $amscontroller,
                    'action'=> 'logout'
                ]
            ] ,

            'attendance' => [
                'POST'=> [
                    'controller' => $amscontroller,
                    'action' => 'attendance'
                ]
            ] ,

            'dates' => [
                'GET' => [
                    'controller'=> $recordController,
                    'action' => 'getDates'
                ]
            ] ,
             'records' => [
                 'GET' => [
                     'controller'=> $recordController,
                     'action' => 'records'
                 ] ,
                 'login'=>true
             ] ,

             'profile' => [
                 'GET' => [
                     'controller' => $studentController,
                     'action' => 'profile'
                 ] ,
                 'login'=> true
             ]
             , 

             'courses' => [
                'GET' => [
                    'controller' => $courseController, 
                    'action' => 'showForm'
                ]  ,
                'POST' => [
                    'controller' => $courseController, 
                    'action' => 'addCourse'
                ],
                'login' => true
             ] , 

             'semesters' => [
                'GET' => [
                    'controller' => $semesterController, 
                    'action' => 'showForm'
                ]  ,
                'POST' => [
                    'controller' => $semesterController, 
                    'action' => 'addSemester'
                ],
                'login' => true
             ]  , 

             'departments' => [
                'GET' => [
                    'controller' => $departmentController, 
                    'action' => 'showForm'
                ]  ,
                'POST' => [
                    'controller' => $departmentController, 
                    'action' => 'addDepartment'
                ], 
                'login' => true
             ]
            
        ];

        return $routes;
   }

   public function getAuthentication(): \Ninja\Authentication
   {
       return $this->authentication;
   }

}
