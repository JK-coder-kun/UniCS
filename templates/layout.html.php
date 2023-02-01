<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- for visualization -->
		<link rel="stylesheet" href="/UniCS/templates/bootstrap.css">
		<link rel="stylesheet" href="/UniCS/templates/style.css">
		<title><?=$title?></title>
        <style>
            #notibell .dropdown-check:checked ~ .dropdown {
                visibility: visible;
                opacity: 1;
            }
            #notibell > .dropdown{
                position: absolute;
                top: 100%;
                left: 0;
                background-color: #fff;
                border: 1px solid #ccc;
                padding: 1rem;
                visibility: hidden;
                opacity: 0;
                width: 250px;
                transition: 0.3s;
            }
            .dropdown li {
                font-size: 9px;
                margin-bottom: 1rem;
                border-bottom: 1px solid #ccc;
                padding-bottom: 1rem;
            }
        </style>
	</head>
	<body>
		


<!-- the template -->
<nav class="navbar bg-future navbar-dark navbar-expand-md sticky-top">
    <div class="container-fluid">
         <!-- notification Bell -->
         <li id="notibell">
                    <label for="check">
                        <i class="bi bi-bell"></i>
                        <span style="color:red;font-size:medium" class="count"><?php echo sizeof($notifications); ?></span>
                    </label>
                    <input type="checkbox" class="dropdown-check" id="check" />
                    <ul class="dropdown">
                        <?php
                        if (sizeof($notifications) > 0) {
                            foreach ($notifications as $item) {
                        ?>
                            <li style="font-size: small;"><?=$item->notiText; ?></br>
                                send at :<?=$item->time?>
                            </li>
                        <?php }
                        } ?>
                    </ul>
                </li>
        <a href="#" class="navbar-brand" id="navbar-brand">uniCS</a>
        <div class="navbar-collapse collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav" id="navbar-ul">
                <li class="nav-item">
                    <a href="/UniCS/public/schedule" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#timetable" class="nav-link">Timetable</a>
                </li>
                <li class="nav-item">
                    <a href="#profile" class="nav-link">Profile</a>
                </li>

                <li class="nav-item">
					<?php if ($loggedIn): ?>
                   	 	<a href="/UniCS/public/logout" class="nav-link">Logout</a>
					<?php else: ?>
						<a href="/UniCS/public/login" class="nav-link">Login</a>
					<?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
						

	<main>
	<?=$output?>
	</main>

	<!-- for visualization -->
<link rel="stylesheet" href="../bootstrap.css">
<link rel="stylesheet" href="../style.css">


<!-- <footer style='position:fixed;bottom:0;width:100%;'> -->
    <footer>
    <div class="card text-center">
        <!-- you should remove 'fixed-bottom' if you implement this into a page -->
        <div class="card-footer text-muted">
            made with <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-heart-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
            </svg> by <span style='color:red'>uniCS</span> team
        </div>
    </div>

</footer>

	</body>
</html>