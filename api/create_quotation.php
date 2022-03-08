<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/quotation.php';

$database = new Database();
$db = $database->get_connection();
$items = new Quotation($db);

$_POST = json_decode(file_get_contents('php://input'),true);

$items->customer_enquiry = $_POST['customer_enquiry'];
$items->des_quant_rate = json_encode($_POST['des_quant_rate']);
$items->total = $_POST['total'];
$create_third_party=$items->create_quotation();
$response_arr = array();
if($create_third_party)
{
    http_response_code(200);
    $response_arr["status"]=200;
    $response_arr["messsage"] = "Quotation created successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(404);
    $response_arr["status"] = 404;
    $response_arr["messsage"]= "Quotation could not be created.";
    echo json_encode($response_arr);
}
