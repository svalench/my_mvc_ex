<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/3controller/init.php';

class MyPage extends BaseController
{
	function __construct() {
     	$this->template = 'startpage.html';
	}
}

$a = new MyPage;
$a->show(['a'=>'this is start page tiny framework','b'=>'if you want now more, please go to ','link'=>'https://github.com/svalench/my_mvc_ex']);
?>