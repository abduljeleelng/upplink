<?php

include_once '../config/database.php';
class staff{
    private $conn;
    private $table_name = "staff";
    //object properties
    public $id;
    public $email;
    public $phone;
    public $names;
    public $salary;
    public $address;
    public $department;
    //construction with db with connection
    public function __construct($db){
        $this->conn = $db;
    }
    function read(){
        $query="SELECT * FROM ".$this->table_name;
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function read_one(){
        $query = "SELECT * FROM ".$this->table_name. " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        //sanitise
        $this->id= htmlspecialchars(strip_tags($this->id));
        //bindParam
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt;
    }
    function checkMail(){
        $query = "SELECT * FROM ".$this->table_name." WHERE email=? LIMIT 0,1 ";
        $stmt = $this->conn->prepare($query);
        //initilise
        $this->email = htmlspecialchars(strip_tags($this->email));
        //bindParameter
        $stmt->bindParam(1,$this->email);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // extract($row);
            $this->id =$row['id'];
            $this->email = $row['email'];
            $this->salary = $row['salary'];
            $this->phone = $row['phone'];
            $this->department = $row['department'];
            $this->names = $row['names'];
            return true;
        }
        return false;
    }
    function create(){
        $query="INSERT INTO ".$this->table_name." SET email=:email, address=:address, salary=:salary, phone=:phone, names=:names, department=:department";
        $stmt=$this->conn->prepare($query);
        //senitise inpute
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->names=htmlspecialchars(strip_tags($this->names));
        $this->salary=htmlspecialchars(strip_tags($this->salary));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->department=htmlspecialchars(strip_tags($this->department));

        //bind parameter
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone',$this->phone);
        $stmt->bindParam(':names',$this->names);
        $stmt->bindParam(':address',$this->address);
        $stmt->bindParam(':salary',$this->salary);
        $stmt->bindParam(':department',$this->department);
        //execute
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function showError($stmt){
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }
    function update(){
        $query= "UPDATE ".$this->table_name." SET address=:address, phone=:phone, names=:names WHERE id =:id";
        $stmt = $this->conn->prepare($query);
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->names = htmlspecialchars(strip_tags($this->names));
        $this->id=htmlspecialchars(strip_tags($this->id));
        // bind the values from the form
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':names', $this->names);
        $stmt->bindParam(':id', $this->id);
        // execute the query
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}