<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/1models/init.php';

// https://oracleplsql.ru/data-types-mysql.html this is link for add type column

class User extends Model
{
	public $column = [
		[
			'name'		=>"id",
			'type'		=>"int",
		 	'PK'		=>true,
		 	"AI"		=>true
		],
		[
			'name'		=>"name",
			'type'		=>'VARCHAR',
			'length'	=>255,
			'default'	=>'none',
			'null'		=> true
		],
		[
			'name'		=>"secondname",
			'type'		=>'VARCHAR',
			'length'	=>255,
			'default'	=>'none',
			'null'		=> true
		],
		[
			'name'		=>"age",
			'type'		=>'int',
			'length'	=>10,
			'null'		=> true
		]
	];
	private $is_super;

	public function __construct()
	{

	}

}





 // $v = $a->exec("INSERT INTO `user` (`name`,`age`) VALUES ('wer',12);");
 // $a->save();
// print_r($a->D);

//print_r($a->get("select * FROM test;"));

?>

