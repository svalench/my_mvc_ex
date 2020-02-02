<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/1models/init.php';




class User
{
	public $model;
	public $id=1;
	public $name;
	public $lastname;
	public $login;
	public $password;
	public $age;
	public $sex;
	private $is_super;


	public function __construct()
	{
		$this->model = new Model();
	}
}



$a = new User();

//$v = $a->model->exec("INSERT INTO `test` (`id`,`name`,`age`,`sex`) VALUES (2,'wer',12,2);");
print_r($a->model->get("select * FROM test;"));

//$a->model->save();
?>