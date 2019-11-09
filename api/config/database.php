<?php

class database{
    private $host = "localhost";
    private $db_name="staffa";
    private $user = "root";
    private $password = "";
    public $conn;

    //get database connection
    public function getConnection(){
        $this->conn=null;
        try{
            $this->conn= new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->user,$this->password);
            $this->conn->exec("set names utf8");
        }catch (PDOException $exception){
            echo "PDO error with error message".$exception->getMessage();
        }
        return $this->conn;
    }
}