<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/inward_outward_site.php';
date_default_timezone_set('Asia/Calcutta'); 


$database = new Database();
$db = $database->get_connection();
$items = new InwardOutwardSite($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_POST = json_decode(file_get_contents('php://input'), true);

    $items->inward_site = $_POST['inward_site'];
    $items->outward_site = $_POST['outward_site'];
    $items->work_order = $_POST['work_order'];
    $items->outward_date = date("Y-m-d");
    $items->outward_time = date("h:i a");
    $items->inward_date = $_POST['inward_date'];
    $items->inward_ = $_POST['inward_time'];
    $create_outward = $items->create_inward_outward_site();
    $response_arr = array();
    if ($create_outward!="duplicate") {
        http_response_code(200);
        $response_arr["status"] = 200;
        $response_arr["messsage"] = "Data created successfully";
        echo json_encode($response_arr);
    }
    else if($create_outward=="duplicate") 
    {
        http_response_code(200);
        $response_arr["status"] = 200;
        $response_arr["messsage"] = "Duplicate Work Order";
        echo json_encode($response_arr);
    }
    else 
    {
        http_response_code(404);
        $response_arr["status"] = 404;
        $response_arr["messsage"] = "Data could not be created.";
        echo json_encode($response_arr);
    }
}
