<?php
    print_r($schedules[2]);
    echo "</br>In ".$day." :</br>";
    for($period=1;$period<=6;$period++){
        echo "period ".$period." : ";
        if($schedules[$period]){
            echo "RoomNumber (".$schedules[$period][0]->roomNo.") ";
            echo "SubjectCode (".$schedules[$period][0]->subjectCode.") ";
        }else echo " ";
        echo "</br>";
    }
    date_default_timezone_set('Asia/Yangon');
    $now=date('h:s');
    echo $now;
    

    ?>
    <ul>
        <?php for($i=0;$i<5;$i++): ?>
            <li><a href="schedule?day=<?=date('l',strtotime("+".$i." days"));?>"><?=date('l',strtotime("+".$i." days"));?></a></li>
        <?php endfor; ?>
        
    </ul>
    <?php header('refresh:3600');