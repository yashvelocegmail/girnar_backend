<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/inward_outward_site.php';

$database = new Database();
$db = $database->get_connection();
$items = new InwardOutwardSite($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->inward_site = $_POST['inward_site'];
$items->outward_site = $_POST['outward_site'];
$items->work_order = $_POST['work_order'];
$items->outward_date = $_POST['outward_date'];
$items->outward_time = $_POST['outward_time'];
$items->inward_date = $_POST['inward_date'];
$items->inward_time = $_POST['inward_time'];
$response = $items->update_inward_outward_site();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Inward-Outward updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(400);
    $response_arr['message'] = "Inward-Outward cannot updated";
    echo json_encode($response_arr);
}
