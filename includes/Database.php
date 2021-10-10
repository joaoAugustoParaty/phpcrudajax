<?php

class Database
{
    private $dbServer = 'localhost';
    private $dbUser = 'root'; //Tenho que trocar 
    private $dbPassword ='';  //Tenho que trocar
    private $dbName = 'playersdb';
    protected $conn;

    public function __construct()
    {

        try{
            $dsn = "mysql:host{$this->dbServer}; dbname={$this->dbName}; charset=utf8";
        $options = array(PDO::ATTR_PERSISTENT);
        $this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword, $options);

        } catch (PDOException $e){
           echo "Connection Error: ". $e->getMessage();
        }
        
    }
}