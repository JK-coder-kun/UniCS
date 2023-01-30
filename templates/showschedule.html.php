
    <!-- <ul>
        <?php for($i=0;$i<5;$i++): ?>
            <li><a href="schedule?day=<?=date('l',strtotime("+".$i." days"));?>"><?=date('l',strtotime("+".$i." days"));?></a></li>
        <?php endfor; ?>
        
    </ul> -->
<?php  
    $days=["Monday","Tuesday","Wednesday","Thursday","Friday"];
    $periods=[0,"8:30 - 9:30","9:40 - 10:40","10:50 - 11:50","12:40 - 1:40","1:50 - 2:50","3:00 - 4:00"];
?>
<!-- the template -->
<div class="container-fluid" id="homepageContainer">
    <!-- period tab -->
    <div class="container">
        <ul class="nav nav-tabs justify-content-center">
            <?php for($n=1;$n<=6;$n++):?>    
                <?php if($n==$period){?>   
                    <li class="nav-item">
                        <a href="/UniCS/public/schedule?day=<?=$day?>&period=<?=$n?>" class="nav-link active"><?=$periods[$n]?></a>
                    </li>
                <?php }else{?>
                    <li class="nav-item">
                        <a href="/UniCS/public/schedule?day=<?=$day?>&period=<?=$n?>" class="nav-link"><?=$periods[$n]?></a>
                    </li>
                <?php }?>
            <?php endfor?>
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
                    $roomNo="2".$floor.$rm;
                    if ($rooms[$roomNo]) {
                        echo "<a href='/UniCS/public/request?roomNo=".$roomNo."' class='btn btn-primary btn-lg room room-taken' role='button'>2" . $floor . $rm . "</a>";
                    } else {
                        echo "<a href='/UniCS/public/request?roomNo=".$roomNo."&period=".$period."&day=".$day."' class='btn btn-primary btn-lg room room-free' role='button'>2" . $floor . $rm . "</a>";
                    }
                }
                echo "<br>";
            }
            ?>
        </div>
    </div>
    <div class="container" style="height:450px;margin-top:20px;width:70%;padding:20px">
        <div style='width:100%;text-align:center'>
            <?php
            $offArr = array();
            for ($i = 0; $i < 5; $i++) {
                
                for ($j = 0; $j < 6; $j++) {
                    $floor = $i + 1;
                    $rm = $j + 1;
                    $roomNo="3".$floor.$rm;
                    if ($rooms[$roomNo]) {
                        echo "<a href='/UniCS/public/request?roomNo=".$roomNo."' class='btn btn-primary btn-lg room room-taken' role='button'>3" . $floor . $rm . "</a>";
                    } else {
                        echo "<a href='/UniCS/public/request?roomNo=".$roomNo."&period=".$period."&day=".$day."' class='btn btn-primary btn-lg room room-free' role='button'>3" . $floor . $rm . "</a>";
                    }
                }
                echo "<br>";
            }
            ?>
        </div>
    </div>
    <!-- day tab -->
    <div class="container">
        <div style='width:100%;text-align:center;margin-bottom:20px;'>
            <ul class="nav nav-pills justify-content-center">
                <?php foreach($days as $d):?>
                    <?php if(strtolower($d)==$day):?>
                        <li class="nav-item">
                            <a class="nav-link active" href="/UniCS/public/schedule?day=<?=$d?>&period=<?=$period?>"><?=$d?></a>
                        </li>
                    <?php else:?>
                        <li class="nav-item">
                            <a class="nav-link" href="/UniCS/public/schedule?day=<?=$d?>&period=<?=$period?>"><?=$d?></a>
                        </li>
                    <?php endif?>
                <?php endforeach;?>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/UniCS/public/schedule?day=monday&period=<?=$period?>">Monday</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/UniCS/public/schedule?day=tuesday&period=<?=$period?>">Tuesday</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/UniCS/public/schedule?day=wednesday&period=<?=$period?>">Wednesday</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/UniCS/public/schedule?day=thursday&period=<?=$period?>">Thursday</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/UniCS/public/schedule?day=friday&period=<?=$period?>">Friday</a>
                </li> -->
            </ul>
        </div>

    </div>
</div>