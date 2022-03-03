<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/leave_tracker.php';

$database = new Database();
$db = $database->get_connection();
$items = new LeaveTracker($db);

$_POST = json_decode(file_get_contents('php://input'),true);

$items->id = $_POST['id'];

$response = $items->delete_leave_tracker_hr();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Leave deleted successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Leave cannot deleted";
    echo json_encode($response_arr);
}
