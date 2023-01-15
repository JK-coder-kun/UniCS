<?php
function autoloader($className) {
	$fileName = str_replace('\\', '/', $className) . '.php';

	$file ='/../classes/' . $fileName;
	
	include $file;
}

spl_autoload_register('autoloader');