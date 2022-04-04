<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/payment.php';

$database = new Database();
$db = $database->get_connection();
$items = new Payment($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_POST = json_decode(file_get_contents('php://input'), true);

    $items->customer = $_POST['customer'];
    $items->purchase_order = $_POST['purchase_order'];
    $items->bill_amount = $_POST['bill_amount'];
    $items->amount_received = $_POST['amount_received'];
    $items->amount_pending = $_POST['amount_pending'];
    $create_payment = $items->create_payment();
    $response_arr = array();
    if ($create_payment) {
        http_response_code(200);
        $response_arr["status"] = 200;
        $response_arr["messsage"] = "Payment created successfully";
        echo json_encode($response_arr);
    } else {
        http_response_code(404);
        $response_arr["status"] = 404;
        $response_arr["messsage"] = "Payment could not be created.";
        echo json_encode($response_arr);
    }
}
