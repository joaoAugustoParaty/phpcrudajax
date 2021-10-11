<?php
require_once 'Database.php';

class Player extends Database
{
    //table name
    protected $tableName = 'players';

    public function add($data) {

        if (!empty($data)){
            $fileds = $placholders = [];
            foreach ($data as $field => $value){
                $fileds[] = $field;
                $placholders[] = ":{$field}";
            }
        }

        $sql = "INSERT INTO {$this->tableName} (".implode(',', $fileds).") VALUES(".implode(',', $placholders) .")";
        $stmt = $this->conn->prepare($sql);

        try {
            //code...
        } catch(PDOException $e){
            
        }
    }
    
}