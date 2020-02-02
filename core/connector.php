<?php

define("DRIVER_DB",$connection['driver']);
define("HOST_DB",$connection['host']);
define("PORT_DB",$connection['port']);
define("USERNAME_DB",$connection['username']);
define("PASSWORD_DB", $connection['password']);
define("SCHEMA_DB",$connection['schema']);

class DB extends PDO
{
	private $default_host;
	private $default_database;
	private $default_login;
	private $default_password;
	private $default_port;
	private $default_driver;
	private $errorExec = false;

    public function __construct($driver = DRIVER_DB, $host = HOST_DB, $port = PORT_DB, $username = USERNAME_DB, $password = PASSWORD_DB, $schema = SCHEMA_DB )
    {
    	$this->default_host 		= $host;
		$this->default_database 	= $schema;
		$this->default_login 		= $username;
		$this->default_password 	= $password;
		$this->default_port 		= $port;
		$this->default_driver 		= $driver;

    	try{

        	$dns = $this->default_driver .
        		':host=' . $this->default_host .
                ';dbname='. $this->default_database .
        		((!empty($this->default_port)) ? (';port=' . $this->default_port) : '') ;
       
        	parent::__construct($dns, $this->default_login, $this->default_password,  [parent::ATTR_ERRMODE => parent::ERRMODE_EXCEPTION]);
        	$this->createDB($this->default_database);

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

}



?>