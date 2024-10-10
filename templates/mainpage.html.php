<div class='container'>
                <div class='first-header'>
                    <div class='cols-8 center-text'>
                        <span class='section-head'>Add a new student</span>
                    </div>
                    <div class='cols-4'>
                        <a href='/dates' class='record-button'>See records</a>
                        <a href='/logout' class='logout-button'>Logout</a>
                    </div>
                    
                </div>
                <div class='form-class'>
                    <form action='' method='post'>
                        <div class='row'>
                            <div class='cols-8'>
                                <input type='text' class='input' placeholder="Student name" name='student[name]'>
                            </div>
                            <div class='cols-4'>
                                <input type='number' class='input' placeholder="Roll number" name='student[roll_no]'>
                            </div>
                            
                        </div>
                        <div class='row'>
                            <div class='cols-4'>
                                <select class='input' name='student[course_id]'>
                                    <option value="" disabled selected hidden>Course</option>
                                    <?php foreach($course as $item): ?>
                                        <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class='cols-4'>
                                <select class='input' name='student[semester_id]'>
                                    <option value="" disabled selected hidden>semester</option>
                                    <?php foreach($semester as $item): ?>
                                        <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class='cols-4'>
                                <select class='input' name='student[department_id]'>
                                    <option value="" disabled selected hidden>Department</option>
                                    <?php foreach($department as $item): ?>
                                        <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>

                        <div class='row'>
                            <input type='submit' value='Add student' class='submit'>
                        </div>

                        

                        
                    </form>
                </div>

                

                <div class='form-class'>
                    <div class='row center-text'>
                        <span class='section-head'>Filter Student List</span>
                    </div>
                    <form action='' method='get'>
                        <div class='row'>
                            <div class='cols-4'>
                            <select class='input' name='course'>
                                    <option value="" disabled selected hidden>Course</option>
                                    <?php foreach($course as $item): ?>
                                        <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class='cols-4'>
                            <select class='input' name='semester'>
                                    <option value="" disabled selected hidden>semester</option>
                                    <?php foreach($semester as $item): ?>
                                        <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class='cols-4'>
                                <select class='input' name='department'>
                                    <option value="" disabled selected hidden>Department</option>
                                    <?php foreach($department as $item): ?>
                                        <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>



                        </div>

                        <div class='row'>
                            <input type='submit' value='go'>
                        </div>
                    </form>
                        <a href='/ams'> Clear filter </a>
                </div>

                <div class='attendance'>
                    <div class='row'>
                        <span class='section-head'>Mark Attendance
                            <?php
                            $today= new DateTime();
                            echo $today->format('Y-m-d');?>
                        </span>
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
                                    <td><a href="/profile?id=<?=$student['id']?>"><?=$student['name']?></a></td>
                                    <td><?=$student['course']?></td>
                                    <td><?=$student['semester']?></td>
                                    <td><?=$student['department']?></td>
                                    <td>
                                        <form action='/attendance' method='post'>
                                            <?php if(count($attended)>0 && in_array($student['id'], $attended)): ?>
                                                 <?=$student_status[$student['id']]?>
                                            <?php else: ?>
                                            <input type="hidden" value="<?=$student['id']?>" name='id'>
                                            <input type='submit' value='a' name='absent'  style='background:tomato;'>
                                            <input type='submit' value='p' name='present'>
                                            <?php endif; ?>
                                        </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>