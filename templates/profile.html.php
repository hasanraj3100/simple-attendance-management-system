<div style='margin-bottom:20px;'>
    <div class='identity'>
    <span class='name'> <?=$name?> </span>
    <span> Roll Number: <?=$roll?> </span>
</div>
    
    <div class='row'>
        <div class='cols-4'>
            <span class='info'> Course: <?=$course?> </span><br>
            <span class='info'> Total Present: <?=$totalP?> day(s) </span>
        </div>
        <div class='cols-4'>
            <span class='info'> semester: <?=$semester?> </span><br>
            <span class='info'> Total Absent: <?=$totalA?> day(s) </span>
        </div>
        <div class='cols-4'>
            <span class='info'> Department: <?=$department?> </span> <br>
            <span class='info'> Attendance rate: <?=$rate?>% </span>
        </div>
        <div style='clear:both;'></div>
    </div>
   
    
</div>

<div id='table'>
    <table id='students'>
        <tr>
            <th>Date</th>
            <th>Attendance</th>
        </tr>
        <?php foreach($attendances as $item): ?>
            <tr>
                <td>
                    <?=$item['date']?>
                </td>
                <td>
                    <?=$item['status']?>
                </td>
            </tr>
        <?php endforeach; ?>
    
    </table>
</div>