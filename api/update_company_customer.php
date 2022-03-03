<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/company_customer_user.php';

$database = new Database();
$db = $database->get_connection();
$items = new CompanyCustomer($db);
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
$items->contact_person_designation = json_encode($data_entity['contact_person_designation']);


$employee_arr=array();
  $customer_updated=$items->update_company_customer();
    if($customer_updated)
    {
        http_response_code(200);
        $employee_arr["status"]=200;
        $employee_arr["messsage"] = "Customer updated successfully";
        echo json_encode($employee_arr);
    }
    else
    {
        http_response_code(404);
        $employee_arr["status"] = 404;
        $employee_arr["messsage"]= "Customer could not be updated.";
        echo json_encode($employee_arr);
    }
