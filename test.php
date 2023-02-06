<layout.html.php>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <!-- js file for carousel -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/UniCS/templates/bootstrap.css">
    <link rel="stylesheet" href="/UniCS/templates/style.css">
    <title><?= $title ?></title>
    <style>
        .carousel-control-prev-icon {
            /* width:0!important; */
            height: 0 !important;
        }

        .carousel-control-next-icon {
            /* width:0!important; */
            height: 0 !important;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-future navbar-dark navbar-expand-md sticky-top">
        <div class="container-fluid">
            <a href="#" class="navbar-brand" id="navbar-brand">U<span style="color:black;">ni</span>CS</a>
            <div class="navbar-collapse collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav" id="navbar-ul">
                    <li class="nav-item">
                        <a href="/UniCS/public/schedule" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile" class="nav-link">Profile</a>
                    </li>
                    <?php if ($loggedIn>=4) : ?>
                        <li class="nav-item">
                            <a href="/UniCS/public/admin/listschedule" class="nav-link">Admin Control</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item mt-2">
                        <a class="" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            <!-- <a href=""> -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                            </svg>
                            <span style='font-size:10px;' class="position-absolute top-10 start-80 translate-middle badge rounded-pill bg-danger">
                                <?php echo sizeof($notifications); ?>
                                <!-- 123 -->
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>

                    </li>
                    
                    <li class="nav-item">
                        <?php if ($loggedIn) : ?>
                            <a href="/UniCS/public/logout" class="nav-link">Logout</a>
                        <?php else : ?>
                            <a href="/UniCS/public/login" class="nav-link">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- offcanvas item -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notifications</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <?php
                            if (sizeof($notifications) > 0) {
                                foreach ($notifications as $item) {
                            ?>
                                    <li style="font-size: small;"><?= $item->notiText; ?></br>
                                        <!-- send at :<?= $item->time ?> -->
                                        send at <?php
                                        $date = date('d-m-y h:i:s');
                                        echo $date;
                                        ?>
                                    </li>
                            <?php }
                            } ?>
        </div>
    </div>

    <div class='container-fluid'>
        <?= $output ?>
    </div>

    <!-- for visualization
    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="../style.css"> -->


    <!-- <footer style='position:fixed;bottom:0;width:100%;'> -->
    <!-- you should remove 'fixed-bottom' if you implement this into a page -->


    <footer>
        <div class="card text-center">
            <div class="card-footer text-muted">
                made with <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                </svg> by <span style='color:red'>uniCS</span> team
            </div>
        </div>
    </footer>

</body>

</html>

</layout.html.php>


<showschedule.html.php>
    <!-- <ul>
    <?php for ($i = 0; $i < 5; $i++) : ?>
            <li><a href="schedule?day=<?= date('l', strtotime("+" . $i . " days")); ?>"><?= date('l', strtotime("+" . $i . " days")); ?></a></li>
        <?php endfor; ?>
        
    </ul> -->
<?php
$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
$periods = [0, "8:30 - 9:30", "9:40 - 10:40", "10:50 - 11:50", "12:40 - 1:40", "1:50 - 2:50", "3:00 - 4:00"];
?>
<!-- the template -->
<div class="container-fluid" id="homepageContainer">
    <!-- period tab -->
    <div class="container">
        <ul class="nav nav-tabs justify-content-center">
            <?php for ($n = 1; $n <= 6; $n++) : ?>
                <?php if ($n == $period) { ?>
                    <li class="nav-item">
                        <a href="/UniCS/public/schedule?day=<?= $day ?>&period=<?= $n ?>" class="nav-link active"><?= $periods[$n] ?></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="/UniCS/public/schedule?day=<?= $day ?>&period=<?= $n ?>" class="nav-link"><?= $periods[$n] ?></a>
                    </li>
                <?php } ?>
            <?php endfor ?>
        </ul>
    </div>
    <!-- rooms container -->
    <div class="container" style="height:450px;margin-top:20px;width:70%;padding:20px">
        <div style='width:100%;text-align:center'>
            <?php
            $offArr = array();
            for ($i = 0; $i < 5; $i++) {
                for ($j = 0; $j < 6; $j++) {
                    $floor = $i + 1;
                    $rm = $j + 1;
                    $roomNo = "2" . $floor . $rm;
                    if ($rooms[$roomNo]) {
                        echo "<a href='/UniCS/public/request?roomNo=" . $roomNo . "' class='btn btn-primary btn-lg room room-taken' role='button'>2" . $floor . $rm . "</a>";
                    } else {
                        echo "<a href='/UniCS/public/request?roomNo=" . $roomNo . "&period=" . $period . "&day=" . $day . "' class='btn btn-primary btn-lg room room-free' role='button'>2" . $floor . $rm . "</a>";
                    }
                }
                echo "<br>";
            }
            ?>
        </div>
        <hr>
        <div style='width:100%;text-align:center'>
            <?php
            $offArr = array();
            for ($i = 0; $i < 5; $i++) {

                for ($j = 0; $j < 6; $j++) {
                    $floor = $i + 1;
                    $rm = $j + 1;
                    $roomNo = "3" . $floor . $rm;
                    if ($rooms[$roomNo]) {
                        echo "<a href='/UniCS/public/request?roomNo=" . $roomNo . "' class='btn btn-primary btn-lg room room-taken' role='button'>3" . $floor . $rm . "</a>";
                    } else {
                        echo "<a href='/UniCS/public/request?roomNo=" . $roomNo . "&period=" . $period . "&day=" . $day . "' class='btn btn-primary btn-lg room room-free' role='button'>3" . $floor . $rm . "</a>";
                    }
                }
                echo "<br>";
            }
            ?>
        </div>
        <!-- day tab -->
        <div class="container mt-5">
            <div style='width:100%;text-align:center;'>
                <ul class="nav nav-pills justify-content-center">
                    <?php foreach ($days as $d) : ?>
                        <?php if (strtolower($d) == $day) : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="/UniCS/public/schedule?day=<?= $d ?>&period=<?= $period ?>"><?= $d ?></a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/UniCS/public/schedule?day=<?= $d ?>&period=<?= $period ?>"><?= $d ?></a>
                            </li>
                        <?php endif ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="container my-5" style="height: 10px;">
        </div>
    </div>

</div>
</showschedule.html.php>


<admin class="editschedule html php">
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

</admin>
<requestroom class="html php">
<?php
    echo "Room :".$roomNo."</br>";
    if(isset($error))echo "<p color='red'>".$error."</p></br>";
    $periods=['0','08:30-09:30','09:40-10:40','10:50-11:50','12:40-01:40','01:50-02:50','03:00-04:00'];
    foreach($roomSchedules as $key=>$values){
        sort($roomSchedules[$key]);
        foreach($values as $value){
            echo "<div style='width:100px;display:inline;'>".$key."</div>";
            echo "<div style='color:red;margin-left:20px;display:inline;'>".$periods[$value['period']]."</div><div style='margin-left:20px;display:inline;'>".($value['section']??"")."</div><div style='margin-left:20px;display:inline;'>".($value['subjectCode']??"")."</div>";
            echo "</br>";
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
        <?php foreach($priority as $reason):?>
            <label for="request[reason]"><?=$reason->reason?></label>
            <input type="radio" name="request[reason]" id="request" value=<?=$reason->reason?>>
        <?php endforeach;?>
        </br></br>
        <input type="submit" value="Send Request">
    </form>
    
</requestroom>