<?php
    echo "Room :".$roomNo."</br>";
    if(isset($error))echo "<p color='red'>".$error."</p></br>";
    $periods=['0','08:30-09:30','09:40-10:40','10:50-11:50','12:40-01:40','01:50-02:50','03:00-04:00'];
    foreach($roomSchedules as $key=>$values){
        sort($roomSchedules[$key]);
        foreach($values as $value){
            echo $key;
            echo "\t".$periods[$value['period']]."</br>";
        }
        echo "</br>";
    }
?>
    <form action="request" method="post">
        <input type="hidden" name="request[roomNo]" value=<?=$roomNo?>>
        <label for="request[period]">Period : </label>
        <input type="number" name="request[period]" id="request" value=<?=$period?> require></br></br>
        <label for="request[day]">Day : </label>
        <input type="text" name="request[day]" id="request" value="<?=$day?>" require></br></br>
        <label for="request[reason]">Reason</label></br>
        Lecture:<input type="radio" name="request[reason]" id="request" value="lecture">
        Seminer:<input type="radio" name="request[reason]" id="request" value="seminer">
        Club activity<input type="radio" name="request[reason]" id="request" value="club activity"></br></br>
        <input type="submit" value="Send Request">
    </form>
    