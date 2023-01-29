<?php
    print_r($rooms);
    echo "</br>In ".$day." :</br>";
    
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