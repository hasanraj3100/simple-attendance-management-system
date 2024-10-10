<?php 
namespace ams\Controllers; 

class semesterController {
    private $semesterTable; 

    public function __construct($semesterTable) {
        $this->semesterTable = $semesterTable; 
    }


    public function showForm() {
        return [
            'title' => "Manage Semester", 
            'template' => "manage.html.php", 
            'variables' => [
                'page_name' => 'Semester'
            ]
        ];
    }


    public function addSemester() {
        $semester = $_POST['semester']; 
        $this->semesterTable->insert($semester); 

        header("Location: /semesters");
    }
}

