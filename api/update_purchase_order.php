<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/purchase_order.php';

$database = new Database();
$db = $database->get_connection();
$items = new PurchaseOrder($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->quotation = $_POST['quotation'];
$items->customer = $_POST['customer'];
$items->des_quant_rate_total = json_encode($_POST['des_quant_rate_total']);
$items->cgst = $_POST['cgst'];
$items->sgst = $_POST['sgst'];
$items->discount = $_POST['discount'];
$items->total = $_POST['total'];
$response = $items->update_purchase_order();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Purchase order updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Purchase order cannot updated";
    echo json_encode($response_arr);
}
