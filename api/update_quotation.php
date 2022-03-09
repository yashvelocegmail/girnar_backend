<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/quotation.php';

$database = new Database();
$db = $database->get_connection();
$items = new Quotation($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->customer_enquiry = $_POST['customer_enquiry'];
$items->des_quant_rate = json_encode($_POST['des_quant_rate']);
$items->total = $_POST['total'];
$response = $items->update_quotation();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Quotation updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Quotation cannot updated";
    echo json_encode($response_arr);
}
