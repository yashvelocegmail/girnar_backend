<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/employee_attendance.php';

$database = new Database();
$db = $database->get_connection();
$items = new EmployeeAttendance($db);
$_POST = json_decode(file_get_contents("php://input"),true);
$items->employee = $_POST['employee'];
$items->date = $_POST['date'];
$records = $items->read_check_approval();
// print_r($records->affected_rows);die;
    $item_count = $records->num_rows;
    
    if($item_count>0)
    {
        $response_arr=array();
        $response_arr['data']=array();
        $response_arr['itemcount'] = $item_count;
        while($row=$records->fetch_assoc())
        {
            array_push($response_arr['data'],$row);
        }
        echo json_encode($response_arr);
    }
    else
    {
        http_response_code(200);
        $response_arr=array();
        $response_arr['data']=array();
        $response_arr['itemcount'] = $item_count;
        echo json_encode($response_arr);
    }
