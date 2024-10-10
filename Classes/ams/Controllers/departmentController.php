<?php 
namespace ams\Controllers; 

class departmentController {
    private $departmentTable; 

    public function __construct($departmentTable) {
        $this->departmentTable = $departmentTable; 
    }


    public function showForm() {
        return [
            'title' => "Manage Courses", 
            'template' => "manage.html.php", 
            'variables' => [
                'page_name' => 'Department'
            ]
        ];
    }


    public function addDepartment() {
        $department = $_POST['department']; 
        echo $course; 
        $this->departmentTable->insert($department); 

       header("Location: /departments");
    }
}

