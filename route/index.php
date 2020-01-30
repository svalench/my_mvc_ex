<?php
/**
 * 
 */
class Route
{
	static function get($path,$fileName)
	{
		$routesInternal = explode('/', $path);
		if(!end($routesInternal)){ exit("error ferst parametr in Route::get! See file /rote/route.php");}
		$routesExternal = explode('/', urldecode($_SERVER['REQUEST_URI']));
		if(!end($routesExternal)){ array_pop($routesExternal);}
		if (count($routesInternal)==count($routesExternal)) {
			$_GET=[];
			foreach ($routesInternal as $key => $value) {
				if($value[0]=='$' && $value[1]!='$')
				{
					$nameVal = substr($value,1);
					$_GET[$nameVal] = $routesExternal[$key];
					$routesExternal[$key] = $value;
				}
			}

			$routesExternalModify = implode("/", $routesExternal);
			if($path == $routesExternalModify)
			{
				$_GLOBAL['route_find'] = true;
				$pathToController = $_SERVER["DOCUMENT_ROOT"].'/controller/'.$fileName.'.php';
				include $pathToController;
				exit();
			}
		}
	}
	static function post()
	{

	}
}
?>