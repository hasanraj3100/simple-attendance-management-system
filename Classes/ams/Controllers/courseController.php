<?php 
namespace ams\Controllers; 

class courseController {
    private $courseTable; 

    public function __construct($courseTable) {
        $this->courseTable = $courseTable; 
    }


    public function showForm() {
        return [
            'title' => "Manage Courses", 
            'template' => "manage.html.php", 
            'variables' => [
                'page_name' => 'Course'
            ]
        ];
    }


    public function addCourse() {
        $course = $_POST['course']; 
        $this->courseTable->insert($course); 

        header("Location: /courses");
    }
}

