<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/third_party.php';

$database = new Database();
$db = $database->get_connection();
$items = new ThirdParty($db);

$_POST = json_decode(file_get_contents('php://input'),true);

$items->name = $_POST['name'];
$items->email = $_POST['email'];
$items->mobile_number = $_POST['mobile_number'];
$items->type_of_operation = $_POST['type_of_operation'];
$create_third_party=$items->create_third_party();
$response_arr = array();
if($create_third_party)
{
    http_response_code(200);
    $response_arr["status"]=200;
    $response_arr["messsage"] = "Third party created successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(404);
    $response_arr["status"] = 404;
    $response_arr["messsage"]= "Third party could not be created.";
    echo json_encode($response_arr);
}
