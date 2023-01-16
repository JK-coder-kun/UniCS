<?php
    print_r($schedules[2]);
    echo "In ".$day." :</br>";
    for($period=1;$period<=6;$period++){
        echo "period ".$period." : ";
        if($schedules[$period]){
            echo "RoomNumber (".$schedules[$period][0]->roomNo.") ";
            echo "SubjectCode (".$schedules[$period][0]->subjectCode.") ";
        }else echo " ";
        echo "</br>";
    }
    ?>
    <ul>
        <?php for($i=0;$i<5;$i++): ?>
            <li><a href="schedule?day=<?=date('l',strtotime("+".$i." days"));?>"><?=date('l',strtotime("+".$i." days"));?></a></li>
        <?php endfor; ?>
        
    </ul>