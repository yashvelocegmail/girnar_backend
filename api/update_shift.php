<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/shift.php';

$database = new Database();
$db = $database->get_connection();
$items = new Shift($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->shift_name = $_POST['shift_name'];
$items->shift_from = $_POST['shift_from'];
$items->shift_to = $_POST['shift_to'];
$response = $items->update_shift();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Shift updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Shift cannot updated";
    echo json_encode($response_arr);
}
