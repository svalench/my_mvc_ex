<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/core/connector.php';




class Model 
{
	private $errorExec;
	public $DB;
	private $table;
	public function __construct($table = '')
	{
		$this->errorExec 	= false;
		$this->table 		= $table;
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
    public function all() {
        $status = $this->DB->query("SELECT * FROM ".$this->table.";")->fetchAll();
        if (!$status) {
        	$this->errorExec = true;
        	return $status;
        }
        else
        {
        	return $status;
        }
    }

        public function get($statement) {
        $status = $this->DB->query($statement)->fetch();
        if (!$status) {
        	$this->errorExec = true;
        	return $status;
        }
        else
        {
        	return $status;
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