<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//
//
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/staff.php';


$database = new database();
$db = $database->getConnection();
$staff = new staff($db);
//get post data
$data = json_decode(file_get_contents("php://input"));
if (!empty($data->id)) {
    $staff->id = $data->id;
    $staff->names = $data->names;
    $staff->address = $data->address;
    $staff->phone = $data->phone;
    if ($staff->update()) {
        // set response code
        http_response_code(200);
        // response in json format
        echo json_encode(
            array(
                "message" => "Staff successfully updated.",
            )
        );

    } else {
        http_response_code(401);
        echo json_encode(array("message" => "unable to update account"));
    }
}else{
    echo json_encode(array("message" => "Staff Id Required"));
}