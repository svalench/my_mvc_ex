<?php
/**
 * 
 */
class Route
{
	 function __construct() {
     
   }

	static function get($path,$fileName)
	{
		$routesInternal = explode('/', $path);
		$lastInternal = @end($routesInternal);
		if(!end($routesInternal))
		{ 
			exit("error ferst parametr in Route::get! See file /rote/route.php");
		}
		$routesExternal = explode('/', urldecode($_SERVER['REQUEST_URI']));
		if(!end($routesExternal) && $lastInternal[0]!='$')
		{
			array_pop($routesExternal);
		}
		if (count($routesInternal)==count($routesExternal)) 
		{
			$_GET = [];
			$_POST = [];
			foreach ($routesInternal as $key => $value) 
			{
				if(@$value[0]==='$' && $value[1]!='$' && ((is_numeric($routesExternal[$key]) && is_int((int)$routesExternal[$key])) or !$routesExternal[$key] ) )
				{
					$nameVal = substr($value,1);
					$_GET[$nameVal] = $routesExternal[$key];
					$routesExternal[$key] = $value;
				}
			}

			$routesExternalModify = implode("/", $routesExternal);
			if($path == $routesExternalModify)
			{
				Route::route($fileName);
			}
		}
	}
	static function post($path,$fileName)
	{
		$routesExternal = explode('/', urldecode($_SERVER['REQUEST_URI']));
		if($path == $_SERVER['REQUEST_URI'])
		{
			$_GET = [];
			Route::route($fileName);
		}
	}
	private static function route($fileName)
	{
		$_GLOBAL['route_find'] = true;
		$pathToController = $_SERVER["DOCUMENT_ROOT"].'/3controller/'.$fileName.'.php';
		include $pathToController;
		exit();	
	}

}
?>