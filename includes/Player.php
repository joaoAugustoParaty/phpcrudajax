<?php
require_once 'Database.php';

class Player extends Database
{
    //table name
    protected $tableName = 'players';

    /** 
     *function is used to add record
     *@param array $data
     *@return int $lastInsertedId

    **/

    public function add($data) {

        if (!empty($data)) {
            $fileds = $placholders = [];
            foreach ($data as $field => $value) {
                $fileds[] = $field;
                $placholders[] = ":{$field}";
            }
        }

        $sql = "INSERT INTO {$this->tableName} (" . implode(',', $fileds) . ") VALUES (" . implode(',', $placholders) . ")";
        $stmt = $this->conn->prepare($sql);
        try {
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $lastInsertedId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $this->conn->rollback();
        }
    }

    /** 
     *function is used to get records
     *@param int $stmt
     *@param int @limit
     *@return array $results

    **/

    public function getRows($start = 0, $limit = 4) /*MUDAR CASO TENHA MAIS ITENS*/ {
        $sql= "SELECT * FROM {$this->tableName} ORDER BY id DESC LIMIT {$start}, {$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() >0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else{

            $results = [];
        }

        return $results;
    }

    /** 
     *function is used to get single record based on the column value
     *@param string $fileds
     *@param any $value
     *@return array $results

    **/

    public function getRow($field,$value){

        $sql = "SELECT * FROM {$this->tableName} WHERE {$field}=:{$field}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$field}" => $value]);
        if($stmt->rowCount() > 0){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }

        return $result;
    }
      /** 
     *function is used to upload file
     *@param array $file
     *@return string $newFileName
    **/
    public function uploadPhoto($file){
        if(!empty($file)){
            $fileTempPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileSize = $file['size'];
            $fileType = $file['type'];
            $fileNameCmps = explode('.', $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time().$fileName).'.'. $fileExtension;
            $allowedExtn = ["jpg", "png", "gif", "jpeg"];
            if(in_array($fileExtension, $allowedExtn)){
                $uploadFileDir = getcwd(). '/uploads/';
                $destFilePath = $uploadFileDir.$newFileName;
                if (move_uploaded_file($fileTempPath, $destFilePath)){
                    return $newFileName;
                }
            }


        }
    }
    
}