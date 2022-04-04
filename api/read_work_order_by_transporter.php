<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/work_order.php';

$database = new Database();
$db = $database->get_connection();
$items = new WorkOrder($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->transporter = $_POST['transporter'];

$records = $items->read_work_order_by_transporter();
        echo $records;

