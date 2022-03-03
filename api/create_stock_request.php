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

$_POST = json_decode(file_get_contents('php://input'),true);

$items->material_type = $_POST['material_type'];
$items->material_thickness = $_POST['material_thickness'];
$items->material_grade = $_POST['material_grade'];
$items->no_of_sheets = $_POST['no_of_sheets'];
$create_stock_request=$items->create_stock_request();
$response_arr = array();
if($create_stock_request)
{
    http_response_code(200);
    $response_arr["status"]=200;
    $response_arr["messsage"] = "Stock request created successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(404);
    $response_arr["status"] = 404;
    $response_arr["messsage"]= "Stock request could not be created.";
    echo json_encode($response_arr);
}
