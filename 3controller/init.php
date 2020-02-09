<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';


 class BaseController
 {
 	public $template;
	function __construct() {
     
	}
	public function show($path='', $param=[])
	{
		$loader = new \Twig\Loader\FilesystemLoader($_SERVER["DOCUMENT_ROOT"].'/2template/');
		$twig = new \Twig\Environment($loader);
		echo $twig->render($this->template, array('name' => 'Fabien'));
	}

 }

?>