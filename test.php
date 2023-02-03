<?php
    date_default_timezone_set('Asia/Yangon');
    for($i=0;$i<7;$i++){
        $dateArray[date('l', strtotime("+" . $i . " days"))]=date('y-m-d', strtotime("+" . $i . " days"));

    }
    print_r($dateArray);
?>