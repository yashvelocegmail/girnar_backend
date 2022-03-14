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

//Serial no Code
// $get_customer_from_customer_enquiry = $items->get_customer_from_customer_enquiry();//print_r($get_customer_from_customer_enquiry);die;
// while ($row = mysqli_fetch_assoc($get_customer_from_customer_enquiry)) {
//     $customer_id=$row["customer_id"];
//     $customer_name = $row["customer_name"];
// }
// $items->customer_id=$customer_id;
// $get_serial_number = $items->get_serial_number();
$get_customer_enquiry = $items->get_customer_enquiry();
while ($row = mysqli_fetch_assoc($get_customer_enquiry)) {
    //print_r($row);die;
    $customer_enquiry = $row["inquiry"];
}

$get_quotation=$items->get_quotation();
	//print_r($customer_enquiry);die;
	$items->quotation=$customer_enquiry."-Quotation-".strval($get_quotation->num_rows+1);
// $items->quotation=$customer_name."-Quotation-".strval($get_serial_number->num_rows+1);
//print_r($items->quotation);die;
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
