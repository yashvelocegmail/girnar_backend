<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/customer_inquiry.php';

$database = new Database();
$db = $database->get_connection();
$items = new CustomerInquiry($db);

$data_entity = json_decode(file_get_contents('php://input'),true);
$items->id = $data_entity['id'];

$response = $items->delete_customer_inquiry();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Inquiry deleted successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Inquiry cannot deleted";
    echo json_encode($response_arr);
}