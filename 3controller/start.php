<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/3controller/init.php';

class MyPage extends BaseController
{
	function __construct() {
     	$this->template = 'startpage.html';
	}
}

$a = new MyPage;
$a->show();
?>