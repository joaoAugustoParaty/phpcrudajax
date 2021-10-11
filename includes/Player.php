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
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $this->conn->commit();
            $lastInsertedId = $this->conn->lastInsertId();
            return $lastInsertedId;
        } catch(PDOException $e){
            echo "Error: ". $e->getMessage();
            $this->conn->rollback();


        }
    }
    
}