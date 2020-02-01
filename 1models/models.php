<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/core/connector.php';


class User extends Model
{
	public $id;
	public $name;
	public $lastname;
	public $login;
	public $paswword;
	public $age;
	public $sex;
	

	public function __construct()
	{
		
	}
}

class Model
{
	private $errorExec;
	private $DB;

	public function __construct()
	{
		$this->errorExec 	= false;
		$this->DB 			= new DB();
	}

	//  Выполняет SQL-запрос и возвращает количество затронутых строк
    public function exec($statement) {
    	if(!$this->DB->inTransaction())
    	{
        	$this->DB->beginTransaction();
        }
        $status = $this->DB->exec($statement);
        if (!$status) {
        	$this->errorExec = true;
        }
    }

//выполняет SQL-запрос без подготовки и возвращает результирующий набор (если есть) в виде объекта
    public function query($statement) {
        if(!$this->DB->inTransaction())
    	{
        	$this->DB->beginTransaction();
        }
        $status = $this->DB->query($statement);
        if (!$status) {
        	$this->errorExec = true;
        }
    }

    public function save()
    {
    	if (!$this->errorExec){
            $this->DB->commit();  
        } else {
            $this->cancel();
            die("You have error! All execeptions rollback!");
        }
    }

    public function cancel()
    {
    	$this->DB->rollBack();
    }
}

?>