<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/monthly_leaves.php';


$database = new Database();
$db = $database->get_connection();
$items = new MonthlyLeaves($db);

$data_entity = json_decode(file_get_contents('php://input'), true);

$date1 = new DateTime();
$date1->setTimestamp(strtotime($data_entity['leave_from']));

$date2 = new DateTime();
$date2->setTimestamp(strtotime($data_entity['leave_to']));

//Sql query for validation check

if ($date1->format('Y-m') === $date2->format('Y-m')) {
    $interval = $date1->diff($date2);
    //print_r($interval->days);die;
    $time = strtotime($data_entity['leave_from']);
    $month = date("m", $time);
    $days = $interval->days;
    $items->employee = $data_entity['employee'];
    $items->month = $month;
    $items->no_of_leaves = $days;
    $response = $items->create_monthly_leaves();//print_r($items);die;
    $response_arr=array();
    if ($response) {
        http_response_code(200);
        $response_arr["status"] = 200;
        $response_arr["messsage"] = "Leaves created successfully";
        echo json_encode($response_arr);
    } else {
        http_response_code(404);
        $response_arr["status"] = 404;
        $response_arr["messsage"] = "Leaves could not be created.";
        echo json_encode($response_arr);
    }
} else {
    //Difference between satrt date and end month
    // $date3=new DateTime();
    $date3 = date("Y-m-t", strtotime($data_entity['leave_from']));
    //$date3=new DateTime();
    $date4 = $data_entity['leave_from'];
    $diff = abs(strtotime($date3) - strtotime($date4));
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $time = strtotime($data_entity['leave_from']);
    $month = date("m", $time);
    $items->employee =  $data_entity['employee'];
    $items->month = $month;
    $items->no_of_leaves = $days+1;
    //print_r($days);die;
    $response = $items->create_monthly_leaves();
    $response_arr=array();
    if ($response) {
        http_response_code(200);
        $response_arr["status"] = 200;
        $response_arr["messsage"] = "Leaves created successfully";
        echo json_encode($response_arr);
    } else {
        http_response_code(404);
        $response_arr["status"] = 404;
        $response_arr["messsage"] = "Leaves could not be created.";
        echo json_encode($response_arr);
    }
    //print_r($days);
    //Difference between end date and start month
    $date5 = date("Y-m-01", strtotime($data_entity['leave_to']));
    //$date3=new DateTime();
    $date6 = $data_entity['leave_to'];
    $diff1 = abs(strtotime($date5) - strtotime($date6));
    $years1 = floor($diff1 / (365 * 60 * 60 * 24));
    $months1 = floor(($diff1 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days1 = floor(($diff1 - $years1 * 365 * 60 * 60 * 24 - $months1 * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    
    $time1 = strtotime($data_entity['leave_to']);
    $month = date("m", $time1);
    $items->employee = "2";
    $items->month = $month;
    $items->no_of_leaves = $days1+1;
    //print_r($days);die;
    $response1 = $items->create_monthly_leaves();
    $response_arr=array();
    if ($response) {
        http_response_code(200);
        $response_arr["status"] = 200;
        $response_arr["messsage"] = "Leaves created successfully";
        echo json_encode($response_arr);
    } else {
        http_response_code(404);
        $response_arr["status"] = 404;
        $response_arr["messsage"] = "Leaves could not be created.";
        echo json_encode($response_arr);
    }
}
