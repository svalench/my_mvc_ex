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


    public function createTable($prefix="")
    {
    	$DB=new DB();
    	$tablename = $prefix.strtolower(get_called_class());
    	$sql = "CREATE TABLE IF NOT EXISTS ".$tablename." ( ";
    	foreach ($this->column as $key => $val) {
    		$sql = $sql.$val['name']." ".$val['type'];
    		if(@$val['length'])
    		{
    			$sql = $sql." (".$val['length'].") ";
    		}
    		if(@$val['null']){
    			$sql = " ".$sql." NULL ";
    		}else{
    			$sql = " ".$sql." NOT NULL ";
    		}
    		if(@$val['default'])
    		{
    			$sql = " ".$sql." DEFAULT '".$val['default']."' ";
    		}
    		if(@$val['AI'])
    		{
    			$sql = " ".$sql." AUTO_INCREMENT ";
    		}
    		if(@$val['PK'])
    		{
    			$sql = " ".$sql." PRIMARY KEY ";
    		}
    		if(@$val['UK'])
    		{
    			if(@$val['PK']){exit("Error!! No use Unik Key and PRIMARY key");}
    			$sql = " ".$sql." UNIQUE KEY ";
    		}
    		if(@$val['comment'])
    		{
    			$sql = " ".$sql." COMMENT '".$val['comment']."'";
    		}
    		if(@$this->column[$key+1]){
    			$sql = $sql.", ";
    		}
    		
    	}
    	$sql = $sql." ); ";
    	print_r($sql);
    	$DB->exec($sql);
    	//$DB->commit();
    	 
    }


}


?>