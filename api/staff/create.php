<?php

header('Cache-Control: no-cache, must-revalidate');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: application/json;charset=utf-8");
header('Access-Control-Allow-Credentials', 'true');
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Origin, Content-Type, Access-Control-Allow-Headers, Authorization, X-requested-width");


//call database and object
include_once "../config/database.php";
include_once "../objects/staff.php";
$database = new database();
$db = $database->getConnection();

$user = new staff($db);
//get post data
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->email)&&
    !empty($data->salary)&&
    !empty($data->department)&&
    !empty($data->phone)&&
    !empty($data->names)){
    $user->email = $data->email;
    $user->salary = $data->salary;
    $user->department = $data->department;
    $user->phone = $data->phone;
    $user->names = $data->names;
    $user->address=$data->address;
    //check is email is not available
    $checkMail = $user->checkMail();
    if ($checkMail){
       // http_response_code(400);
        //echo json_encode(array("message"=>"Unable to Account  created"));

        echo '{';
        echo '"message":"Email already exist"';
        echo '}';

    }else{
        /*
        echo '{';
        echo '"message":"Email available"';
        echo '}';
        */
        if ($user->create()){
            http_response_code(200);
            echo json_encode(array("note"=>"Account successfully created"));
            /*
            echo '{';
            echo '"message":"Account successfully created"';
            echo '}';
            */
        }else{
            http_response_code(400);
            echo json_encode(array("message"=>"Unable to Account  created"));
           /*
            echo '{';
            echo '"message":"Unable to Account  created"';
            echo '}';
           */
        }
    }
}else{
    http_response_code(400);
    echo json_encode(array("message"=>"all the data required"));
}
