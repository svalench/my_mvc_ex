<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/route/index.php';

//Route::get('/$wert','my');
Route::get('/my','my');
if(!$_GLOBAL['route_find'])
{
	print_r('route not find');
}
?>