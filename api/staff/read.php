<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: Application/json; charset=UTF-8");

//include database and object file
include_once "../config/database.php";
include_once "../objects/staff.php";
//instantiate  database and object file
$database = new Database();
$db = $database->getConnection();
//initialise object
$user = new staff($db);

// query product
$stmt = $user->read();
$count = $stmt->rowCount();

//check if ther's record in database
if ($count>0){
    //staff array
    $user_arr=array();
    $user_arr["record"]=array();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $staff_data=array(
            "id"=>$id,
            "email"=>$email,
            "Salary"=>$salary,
            "Department"=>$department,
            "phone"=>$phone,
            "names"=>$names,
            "Address"=>$address
        );
        array_push($user_arr["record"],$staff_data);
    }
    echo json_encode($user_arr);
}else{
    echo json_encode(
        array("message" => "no staff found")
    );
}
