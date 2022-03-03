<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/customer_and_user.php';


$uniqueid = uniqid();
$database = new Database();
$db = $database->get_connection();
$items = new Customer($db);

$data_entity = json_decode(file_get_contents('php://input'), true);
$items->id = $data_entity['id'];
$items->name = $data_entity['name'];
$items->address1 = $data_entity['address1'];
$items->address2 = $data_entity['address2'];
$items->address3 = $data_entity['address3'];
$items->mobile_number = $data_entity['mobile_number'];
$items->email_id = $data_entity['email_id'];
$items->website = $data_entity['website'];
$items->director_name = $data_entity['director_name'];
$items->director_mobile = $data_entity['director_mobile'];
$items->director_email_id = $data_entity['director_email_id'];
$items->type_of_industry = $data_entity['type_of_industry'];
$items->gst = $data_entity['gst'];
$items->pan = $data_entity['pan'];
$items->tan = $data_entity['tan'];
$items->username = $data_entity['username'];
$items->password = $data_entity['password'];
$items->user_type = "customer";

$response = $items->update_customer();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Customer updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Customer cannot updated";
    echo json_encode($response_arr);
}
