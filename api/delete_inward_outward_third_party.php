<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/inward_outward_third_party.php';

$database = new Database();
$db = $database->get_connection();
$items = new InwardOutward($db);

$data_entity = json_decode(file_get_contents('php://input'),true);
$items->id = $data_entity['id'];

$response = $items->delete_inward_outward();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "InwardOutward deleted successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "InwardOutward cannot deleted";
    echo json_encode($response_arr);
}
