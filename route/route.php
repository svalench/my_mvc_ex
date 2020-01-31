<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


include_once $_SERVER["DOCUMENT_ROOT"].'/route/index.php';

Route::get('/$wert','my');
Route::get('/my','my');
if(!@$_GLOBAL['route_find'])
{
	print_r('route not find');
}
?>