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
    <div id="roomsCarousel" class="container carousel carousel-dark slide" style="margin-top:20px;width:100%;padding:10px;">
        <div class="carousel-inner">

            <div class='carousel-item active' style='width:100%;text-align:center'>
                <span style='text-align:center;display:block;'>Building 2</span>
                <?php
                for ($i = 0; $i < 5; $i++) {
                    for ($j = 0; $j < 6; $j++) {
                        $floor = $i + 1;
                        $rm = $j + 1;
                        $roomNo = "2" . $floor . $rm;
                        if (array_key_exists($roomNo, $rooms) && $rooms[$roomNo]) {
                            echo "<a href='/UniCS/public/request?roomNo=" . $roomNo . "' class='btn btn-primary btn-lg room room-taken' role='button'>2" . $floor . $rm . "</a>";
                        } else {
                            echo "<a href='/UniCS/public/request?roomNo=" . $roomNo . "&period=" . $period . "&day=" . $day . "' class='btn btn-primary btn-lg room room-free' role='button'>2" . $floor . $rm . "</a>";
                        }
                    }
                    echo "<br>";
                }
                ?>
            </div>
            <div class='carousel-item' style='width:100%;text-align:center'>
                <span style='text-align:center;display:block;'>Building 3</span>
                <?php
                for ($i = 0; $i < 5; $i++) {

                    for ($j = 0; $j < 6; $j++) {
                        $floor = $i + 1;
                        $rm = $j + 1;
                        $roomNo = "3" . $floor . $rm;
                        if (array_key_exists($roomNo, $rooms) && $rooms[$roomNo]) {
                            echo "<a href='/UniCS/public/request?roomNo=" . $roomNo . "' class='btn btn-primary btn-lg room room-taken' role='button'>3" . $floor . $rm . "</a>";
                        } else {
                            echo "<a href='/UniCS/public/request?roomNo=" . $roomNo . "&period=" . $period . "&day=" . $day . "' class='btn btn-primary btn-lg room room-free' role='button'>3" . $floor . $rm . "</a>";
                        }
                    }
                    echo "<br>";
                }
                ?>
            </div>
        </div>

        <!-- carousel buttons -->
        <button class="carousel-control-prev carouselButton" type="button" data-bs-target="#roomsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next carouselButton" type="button" data-bs-target="#roomsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                </svg>
            </span>
            <span class="visually-hidden">Next</span>
        </button>


        <!-- <div class="container my-5" style="height: 10px;">
        </div> -->
    </div>
    <!-- day tab -->
    <div class="mb-3">
        <div style='width:100%;'>
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
</div>