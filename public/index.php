<?php

use Common\DatabaseTable;

try {
	include '/opt/lampp/htdocs/UniCS/'.'./includes/autoload.php';
	//include './../classes/Common/EntryPoint.php';
	
	$route =strtok($_SERVER['REQUEST_URI'], '?');
	$route= substr($route,14);
	echo $route."</br>".$_SERVER['REQUEST_METHOD']."</br>";

	$entryPoint = new \Common\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Unics\Routes());
	$entryPoint->run();
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();

	include '/../templates/layout.html.php';
}


