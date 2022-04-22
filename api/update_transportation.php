<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/transportation.php';

$database = new Database();
$db = $database->get_connection();
$items = new  Transportation($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->work_order = $_POST['work_order'];
$items->address = $_POST['address'];
$items->date = date("Y-m-d");
$items->status = $_POST['status'];
if($_POST['status']=="delivered")
{
    $items->update_work_order_as_completed();
    $response = $items->update_transportation();
}
else
{
    $items->update_work_order_as_assigned();
    $response = $items->update_transportation();
}

$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Transportation updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Transportation cannot updated";
    echo json_encode($response_arr);
}
