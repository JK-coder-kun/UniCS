<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/jokes.css">
		<title><?=$title?></title>
	</head>
	<body>
	<nav>
		<header>
			<h1>University Classrooms Scheduler</h1>
		</header>
		<ul>
			<li><a href="home">Home</a></li>
			<li><a href="../schedule">Schedule</a></li>
            <?php if ($loggedIn): ?>
			<li><a href="../logout">Log out</a></li>
			<?php else: ?>
			<li><a href="login">Log in</a></li>
			<?php endif; ?>
		</ul>
	</nav>

	<main>
	<?=$output?>
	</main>

	<footer>
	&copy; Unics 2022
	</footer>
	</body>
</html>