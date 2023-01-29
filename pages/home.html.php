<html>
<?php
// header("refresh: 2");
?>

<head>
    <title>Home</title>
    <script src="bootstrap.js"></script>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar bg-future navbar-dark navbar-expand-md">
        <div class="container-fluid">
            <a href="#" class="navbar-brand" id="navbar-brand">uniCS</a>
            <div class="navbar-collapse collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav" id="navbar-ul">
                    <li class="nav-item">
                        <a href="#home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#timetable" class="nav-link">Timetable</a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.html.php" class="nav-link">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid" id="homepageContainer">
        <!-- period tab -->
        <div class="container">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a href="" class="nav-link">8:30 - 9:30</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link active">9:40 - 10:40</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">10:50 - 11:50</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">12:40 - 1:40</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">1:50 - 2:50</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">3:00 - 4:00</a>
                </li>
            </ul>
        </div>
        <!-- rooms container -->
        <div class="container" style="height:450px;margin-top:20px;width:70%;padding:20px">
            <div style='width:100%;text-align:center'>
                <?php
                $offArr = array();
                for ($i = 0; $i < 5; $i++) {
                    $offlineNum = rand(1, 5);
                    for ($a = 0; $a < $offlineNum - 1; $a++) {
                        $rand = rand(0, 5);
                        if (in_array($rand, $offArr)) {
                            continue;
                        } else {
                            array_push($offArr, $rand);
                        }
                    }
                    for ($j = 0; $j < 6; $j++) {
                        $bldg = $i + 1;
                        $rm = $j + 1;
                        if (in_array($j, $offArr)) {
                            echo "<a class='btn btn-primary btn-lg room room-taken' role='button'>2" . $bldg . $rm . "</a>";
                        } else {
                            echo "<a class='btn btn-primary btn-lg room room-free' role='button'>2" . $bldg . $rm . "</a>";
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
                    <li class="nav-item">
                        <a class="nav-link" href="#">Monday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tuesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Wednesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Thursday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Friday</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

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