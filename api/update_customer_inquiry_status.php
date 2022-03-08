<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/customer_inquiry.php';

$database = new Database();
$db = $database->get_connection();
$items = new CustomerInquiry($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->status = $_POST['status'];
$response = $items->update_customer_inquiry_status();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Status updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Status cannot updated";
    echo json_encode($response_arr);
}
