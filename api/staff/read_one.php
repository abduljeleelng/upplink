<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/staff.php';

$database = new database();
$db= $database->getConnection();
$user = new staff($db);
//$data=json_encode(file_get_contents('php://input'));
$user->id= isset($_GET['id']) ? $_GET['id'] :die();
$stmt = $user->read_one();
$num = $stmt->rowCount();
if ($num>0){
    $user_arr = array();
    $user_arr["record"] = array();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $staff_data=array(
        "id"=>$id,
        "email"=>$email,
        "Salary"=>$salary,
        "Department"=>$department,
        "phone"=>$phone,
        "names"=>$names,
        "address"=>$address
    );
    array_push($user_arr["record"],$staff_data);
    json_encode($user_arr);
    print_r(json_encode($staff_data));
}else{
    echo '{';
    echo '"messages":"no record found"';
    echo '}';
}