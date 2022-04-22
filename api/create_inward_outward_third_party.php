<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/inward_outward_third_party.php';
date_default_timezone_set('Asia/Calcutta'); 


$database = new Database();
$db = $database->get_connection();
$items = new InwardOutward($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_POST = json_decode(file_get_contents('php://input'), true);

    $items->work_order = $_POST['work_order'];
    $items->third_party_name = $_POST['third_party_name'];
    $items->outward_date = date("Y-m-d");
    $items->outward_time = date("h:i a");
     $items->inward_date = $_POST['inward_date'];
    $items->inward_ = $_POST['inward_time'];
    $create_outward = $items->create_outward();
    $response_arr = array();
    if ($create_outward!="duplicate") {
        http_response_code(200);
        $response_arr["status"] = 200;
        $response_arr["messsage"] = "Outward created successfully";
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
        $response_arr["messsage"] = "Outward could not be created.";
        echo json_encode($response_arr);
    }
}
