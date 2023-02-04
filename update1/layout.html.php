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
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
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