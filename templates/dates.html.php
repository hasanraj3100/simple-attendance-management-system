
 
                    <div class='row'>
                        <span class='section-head'>Attendance data</span>
                    </div>
                    

                    <div class='row'>
                        <table id='students'>
                            <tr>
                                <th> Dates</th>
                            </tr>
                            <?php foreach($data as $item): ?>
                            <tr>
                                <td>
                                <a href="/records?date=<?=$item['date']?>"><?=$item['date']?></a>
                            </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                   