<?php

// function autoloader($className){
//   $file = __DIR__ . '/../classes/' . $className . '.php';

// }
// sql_autoload_register('autoloader');

function autoloader($className) {
	$fileName = str_replace('\\', '/', $className) . '.php';

	$file = __DIR__ . '/../classes/' . $fileName;

	include $file;
}

spl_autoload_register('autoloader');