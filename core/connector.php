<?php

class DB extends PDO
{
	private $errorExec = false;
    public function __construct($connection)
    {

    	try{
        	$dns = $connection['driver'] .
        		':host=' . $connection['host'] .
        		((!empty($connection['port'])) ? (';port=' . $connection['port']) : '') ;
       
        	parent::__construct($dns, $connection['username'], $connection['password']);
        	$this->createDB($connection['schema']);
        }
        catch(PDOException $e)
        {
        	echo ($e->getMessage()); 
        	
        }

    }
    private function createDB($dbname)
    {
    	$this->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    }
//  Выполняет SQL-запрос и возвращает количество затронутых строк
    public function exec($statement) {
        @$this->beginTransaction();
        $status = $this->exec($statement);
        if (!$status) {
        	$this->errorExec = true;
        }
    }

//выполняет SQL-запрос без подготовки и возвращает результирующий набор (если есть) в виде объекта
    public function query($statement) {
        @$this->beginTransaction();
        $status = $this->query($statement);
        if (!$status) {
        	$this->errorExec = true;
        }
    }

    public function save()
    {
    	if (!$this->errorExec){
            $this->commit();  
        } else {
            $this->rollback();
            die("You have error! All execeptions rollback!");
        }
    }

    public function cancel()
    {
    	$this->rollback();
    }
}



?>