<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/1models/init.php';




class User extends Model
{
	protected $column = [
		[
			'name'		=>"id",
			'type'		=>"int",
		 	'PK'		=>true,
		 	"AI"		=>true
		],
		[
			'name'		=>"name",
			'type'		=>'char',
			'length'	=>255,
			'default'	=>'none'
		],
		[
			'name'		=>"secondname",
			'type'		=>'char',
			'length'	=>255,
			'default'	=>'none'
		],
		[
			'name'		=>"age",
			'type'		=>'int',
			'length'	=>10
		]
	];
	private $is_super;

	public function __construct()
	{

	}

}


$a = new User;


// $v = $a->exec("INSERT INTO `test` (`id`,`name`,`age`,`sex`) VALUES (2,'wer',12,2);");
// print_r($a->D);

//print_r($a->get("select * FROM test;"));

?>

