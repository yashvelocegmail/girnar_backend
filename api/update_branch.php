<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/branch.php';

$database = new Database();
$db = $database->get_connection();
$items = new Branch($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->branch_name = $_POST['branch_name'];
$items->address = $_POST['address'];
$response = $items->update_branch();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "branch updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "branch cannot updated";
    echo json_encode($response_arr);
}
