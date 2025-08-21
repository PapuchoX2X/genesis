<?php
// elemental require
require_once (dirname (__FILE__) . "/app/db.php");
require_once (dirname (__FILE__) . "/app/html.php");
/*
//function __autoload ($class) {
function autoloader ($class) {
	$class = strtolower ($class);
	$directory = "class";
	
	if (strcasecmp ($class, "temp") == 0) {
		$directory = "class/form";
	}
	
	$path = dirname (__FILE__) . "/$directory/$class.php";
	
	require_once ($path);
}

spl_autoload_register('autoloader');
*/
spl_autoload_register(function($class) {
	$class = strtolower ($class);
	$directory = "class";
	
	if (strcasecmp ($class, "temp") == 0) {
		$directory = "class/form";
	}
	
	$path = dirname (__FILE__) . "/$directory/$class.php";
	
	require_once ($path);
});

?>