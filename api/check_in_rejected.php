<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/employee_attendance.php';

$database = new Database();
$db = $database->get_connection();
$items = new EmployeeAttendance($db);

$_POST = json_decode(file_get_contents('php://input'),true);

$items->id = $_POST['id'];
//$items->employee = $_POST['employee'];
$check_in_approval=$items->check_in_rejected();
$response_arr = array();
if($check_in_approval)
{
    http_response_code(200);
    $response_arr["status"]=200;
    $response_arr["messsage"] = "Checked In Rejected Successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr["status"] = 404;
    $response_arr["messsage"]= "Cannot Rejected Check In";
    echo json_encode($response_arr);
}
