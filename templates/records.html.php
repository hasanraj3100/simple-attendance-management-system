        <div class='attendance'>
                    <div class='row'>
                        <span class='section-head'>Attendance Data <?=$_GET['date']?>
                        </span>
                    </div>

                    <div class='info-section'>
                    
                        <div class='cols-6'>
                            <b>Total absent: <?=$absentCount?> </b>
                        </div>
                        <div class='cols-6'>
                            <b>Total present: <?=$presentCount?> </b>
                        </div>
                    </div>
                    

                    <div id='table'>
                        <table id='students'>
                            <tr>
                                <th>Roll</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>semester</th>
                                <th>Department</th>
                                <th>Attendance</th>
                            </tr>
    
                            <?php foreach($students as $student): ?>
                                <tr>
                                    <td><?=$student['roll']?></td>
                                    <td><?=$student['name']?></td>
                                    <td><?=$student['course']?></td>
                                    <td><?=$student['semester']?></td>
                                    <td><?=$student['department']?></td>
                                    <td>
                                        <?php if($student_status[$student['id']]=='absent'): ?>
                                    <span class='tomato'><?=$student_status[$student['id']]?></span>
                                        <?php else: ?>
                                            <span class='green'><?=$student_status[$student['id']]?></span>
                                        <?php endif; ?>
                                    </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>