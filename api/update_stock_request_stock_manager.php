<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/stock_request.php';

$database = new Database();
$db = $database->get_connection();
$items = new StockRequest($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->material_type = $_POST['material_type'];
$items->material_thickness = $_POST['material_thickness'];
$items->material_grade = $_POST['material_grade'];
$items->no_of_sheets = $_POST['no_of_sheets'];
$items->status = $_POST['status'];
$response = $items->update_stock_request_stock_manager();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Stock request type updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Stock request type cannot updated";
    echo json_encode($response_arr);
}
