<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/purchase_order.php';

$database = new Database();
$db = $database->get_connection();
$items = new PurchaseOrder($db);

$_POST = json_decode(file_get_contents('php://input'),true);
$items->quotation = $_POST['quotation'];
$items->customer=$_POST["customer"];

$get_quotation_from_quotation = $items->get_quotation_from_quotation();//print_r($get_customer_from_customer_enquiry);die;
while ($row = mysqli_fetch_assoc($get_quotation_from_quotation)) {
    $quotation_number = $row["quotation"];
}
$items->customer_id=$customer_id;
$get_serial_number = $items->get_serial_number();
//print_r($get_serial_number->num_rows);die;
//$items->purchase_order = $_POST['purchase_order'];
$items->purchase_order=$quotation_number."-Purchase Order-".strval($get_serial_number->num_rows+1);
$items->customer = $_POST['customer'];
$items->des_quant_rate_total = json_encode($_POST['des_quant_rate_total']);
$items->cgst = $_POST['cgst'];
$items->sgst = $_POST['sgst'];
$items->discount = $_POST['discount'];
$items->total = $_POST['total'];
$create_purchase_order=$items->create_purchase_order();
$response_arr = array();
if($create_purchase_order)
{
    http_response_code(200);
    $response_arr["status"]=200;
    $response_arr["messsage"] = "Purchase order created successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(404);
    $response_arr["status"] = 404;
    $response_arr["messsage"]= "Purchase Order could not be created.";
    echo json_encode($response_arr);
}
