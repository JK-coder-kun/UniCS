<?php
try {
	include '/../includes/autoload.php';
	//include './../classes/Ninja/EntryPoint.php';
	$route = $_GET['route'] ?? '';


	$entryPoint = new EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Unics\Routes());
	$entryPoint->run();
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();

	include '/../templates/layout.html.php';
}


