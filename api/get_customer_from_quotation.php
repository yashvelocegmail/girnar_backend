<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/quotation.php';

$database = new Database();
$db = $database->get_connection();
$items = new Quotation($db);

$_POST = json_decode(file_get_contents("php://input"), true);
$items->quotation = $_POST['quotation'];

$records = $items->get_customer_from_quotation();
//print_r($records);die;
$item_count = $records->num_rows;
//echo json_encode($item_count);
if ($item_count > 0) {
    http_response_code(200);
    $response_arr = array();
    $response_arr['data'] = array();
    $response_arr['itemcount'] = $item_count;
    while ($row = $records->fetch_assoc()) {
        array_push($response_arr['data'], $row);
    }
    echo json_encode($response_arr);
} else {
    http_response_code(200);
    $response_arr = array();
    $response_arr['data'] = array();
    $response_arr['itemcount'] = $item_count;
    echo json_encode($response_arr);
}
