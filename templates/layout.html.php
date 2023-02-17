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
            height: 0 !important;
        }

        .carousel-control-next-icon {
            height: 0 !important;
        }

        .dummy-form-title {
            border: 0px solid white;
            border-radius: 0.375em;
            color: white;
            text-align: center;
            /* it's bg-dark's color */
            background-color: #212529;
        }

        .dummy-form-content {
            border: 0px solid white;
            text-align: center;
            color: indigo;
        }

        /* footer problem fixed? */
        /* https://stackoverflow.com/questions/4575826/how-to-push-a-footer-to-the-bottom-of-page-when-content-is-short-or-missing */
        .flex-wrapper {
            display: flex;
            min-height: 90vh;
            flex-direction: column;
            justify-content: space-between;
        }

        .form-control,
        .form-select {
            /* color changed to a shade of --bs-border-color: #dee2e6; */
            border-color: #a8b3bd;
        }

        .room-denied {
            background: #000;
            opacity:0.8;
        }
        .room-denied > a{
            font-weight:lighter;
        }
    </style>
    <script>
        function changeStatus(id, userid) {
            var xhttp = new XMLHttpRequest();
            var totalNoti = document.getElementById("totalUnread").value;
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("totalUnread").innerHTML = this.responseText;
                    // document.getElementById("noti").innerHTML = '<span class="position-absolute top-10 start-80 translate-middle badge rounded-pill bg-danger"><span id="totalUnread"><?php echo $totalUnread; ?></span><span class="visually-hidden">unread messages</span></span>';
                }
            };
            //alert("you click noti"+st);
            xhttp.open("GET", "../templates/changeNotiStatus.php?userId=" + userid + "&notiId=" + id, true);
            xhttp.send();
            //document.getElementById("totalNoti").innerHTML = totalNoti;

        }
    </script>
</head>

<body>
    <div id="demo"></div>
    <nav class="navbar bg-primary navbar-dark navbar-expand-md sticky-top">
        <div class="container-fluid">
            <a href="#" class="navbar-brand" id="navbar-brand">U<span style="color:#FF6A00;">ni</span>CS</a>
            <div class="navbar-collapse collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav" id="navbar-ul">
                    <li class="nav-item">
                        <a href="/UniCS/public/schedule" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/UniCS/public/profile" class="nav-link">Profile</a>
                    </li>

                    <?php if ($loggedIn->permissions >= 4) : ?>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Admin</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/UniCS/public/admin/listschedule" class="dropdown-item">Edit Schedule</a>
                                </li>
                                <li>
                                    <a href="/UniCS/public/admin/priority" class="dropdown-item">Edit Priority</a>
                                </li>
                                <li>
                                    <a href="/UniCS/public/listuser" class="dropdown-item">User List</a>
                                </li>
                                <li>
                                    <a href="/UniCS/public/register" class="dropdown-item">Register User</a>
                                </li>
                            </ul>

                        </li>
                    <?php else : ?>
                        <li class="nav-item dropdown">
                            <a href="/UniCS/public/searchschedule" class="nav-link " role="button">Search Schedule</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item mt-2">
                        <a class="" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            <!-- bell color changed -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                            </svg>
                            <span class="position-absolute top-10 start-80 translate-middle badge rounded-pill bg-danger">
                                <span id="totalUnread">
                                    <?php echo $totalUnread; ?>
                                </span>


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
    <!-- this is the notification side pop up -->
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
                    <form method="get">
                        <li onclick="changeStatus('<?= $item->id; ?>','<?= $item->userid; ?>')" style="font-size: small;"><?= $item->notiText; ?></br>
                            <!-- send at :<?= $item->time ?> -->
                            <em>send at <?= $item->time ?></em>
                        </li>
                    </form>

                    <hr>
            <?php }
            } ?>
        </div>
    </div>

    <div class='flex-wrapper'>
        <div class='container-fluid'>
            <?= $output ?>
        </div>

        <!-- <footer> -->
        <div class="card text-center">
            <div class="card-footer text-muted">
                made with <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                </svg> by <span style='color:red'>uniCS</span> team
            </div>
        </div>
        <!-- </footer> -->
    </div>
</body>

</html>