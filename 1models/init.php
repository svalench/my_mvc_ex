<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/core/connector.php';





class Model 
{
	public $column =[];
	private $errorExec;
	private $table;
	private $D;
	public function __construct($table = '')
	{
		$this->errorExec 	= false;
		$this->table 		= $table;
	}

	//  Выполняет SQL-запрос и возвращает количество затронутых строк
    public function exec($statement) {
    	$this->D = new DB();
    	if(!$this->D->inTransaction())
    	{
        	$this->D->beginTransaction();
        }
        $status = $this->D->exec($statement);
        if (!$status) {
        	$this->errorExec = true;
        }
    }

//выполняет SQL-запрос без подготовки и возвращает результирующий набор (если есть) в виде объекта
    public function all() {
    	$DB=new DB();
        $status = $DB->query("SELECT * FROM ".$this->table.";")->fetchAll();
        if (!$status) {
        	$status = "error response";
        	return $status;
        }
        else
        {
        	return $status;
        }
    }

        public function get($statement) {
        	$DB=new DB();
        $status = $DB->query($statement)->fetch();
        if (!$status) {
        	$status = "error response";
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
            $this->D->commit();  
        } else {
            $this->D->rollBack();
            die("You have error! All execeptions rollback!");
        }
    }

    public function cancel()
    {
    	$this->D->rollBack();
    }





}


?>