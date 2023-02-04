<?php 
print_r($filter);
$postFilter="";
?>
<?php foreach($filter as $key=>$value){
        $postFilter.="<input type=\"hidden\" name=\"filter[".$key."]\" value=\"".$value."\">";
    }?>

<form action="/UniCS/public/admin/listschedule" method="get">
    <label for="filter[roomNo]">RoomNo</label>
    <span><input type="number" name="filter[roomNo]" id="" value=<?=$filter['roomNo']??''?> ></span>
    <label for="filter[period]">Period</label>
    <span><input type="number" name="filter[period]" id="" value=<?=$filter['period']??''?>></span>
    <label for="filter[day]">Day</label>
    <span><input type="text" name="filter[day]" id="" value=<?=$filter['day']??''?>></span>
    <label for="filter[section]">Section</label>
    <span><input type="text" name="filter[section]" id="" value=<?=$filter['section']??''?>></span>
    <label for="filter[subjectCode]">subjectCode</label>
    <span><input type="number" name="filter[subjectCode]" id="" value=<?=$filter['subjectCode']??''?>></span>
    <input type="submit" value="Filter">
</form>
<button><a href="/UniCS/public/admin/listschedule">All</a></button>
</br>

<?php foreach($result as $row):?>
    <form action="/UniCS/public/admin/editschedule" method="post">
    <?=$postFilter?>
    <input type="hidden" name="schedule[id]" value=<?=$row->id?>>
    <span><input type="number" name="schedule[roomNo]" id="" value=<?=$row->roomNo?> ></span>
    <span><input type="number" name="schedule[period]" id="" value=<?=$row->period?>></span>
    <span><input type="text" name="schedule[day]" id="" value=<?=$row->day?>></span>
    <span><input type="text" name="schedule[section]" id="" value=<?=$row->section ?>></span>
    <span><input type="number" name="schedule[subjectCode]" id="" value=<?=$row->subjectCode?>></span>
    <span><input type="submit" value="Edit"></span>
</form>
<form action="/UniCS/public/admin/deleteschedule" method="post">
    <input type="hidden" name="id" value=<?=$row->id?>>
    <?=$postFilter?>
    <input type="submit" value="Delete">
</form>
<?php endforeach;?>    

</br>
<form action="/UniCS/public/admin/addschedule" method="post">
    <?=$postFilter?>
    <span><input type="number" name="schedule[roomNo]" id="" value=<?=$filter['roomNo']??''?> required></span>
    <span><input type="number" name="schedule[period]" id="" value=<?=$filter['period']??''?> required></span>
    <span><input type="text" name="schedule[day]" id="" value=<?=$filter['day']??''?> ></span>
    <span><input type="text" name="schedule[section]" id="" value=<?=$filter['section']??''?> ></span>
    <span><input type="number" name="schedule[subjectCode]" id="" value=<?=$filter['subjectCode']??''?> ></span>
    <input type="submit" value="Add Schedule">
</form>
