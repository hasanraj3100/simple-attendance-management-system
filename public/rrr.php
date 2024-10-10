<?php

use Ninja\DatabaseTable;

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../Classes/Ninja/DatabaseTable.php';

$table= new DatabaseTable($pdo, 'attendace', 'id');

$dates= $table->find('date', '2021-10-24');

foreach($dates as $date) {
    echo $date['student_id'] . '<br>';
}