<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/employee_and_user.php';

$database = new Database();
$db = $database->get_connection();
$items = new Employee($db);
$data_entity = json_decode(file_get_contents('php://input'), true);

$items->username = $data_entity['username'];
$items->password = $data_entity['password'];
$login_employee = $items->login_employee();
//print_r($login_employee);die;
$employee_arr=array();
$employee_arr['data'] = array();
if($login_employee->num_rows>0)
{
    while($row=$login_employee->fetch_assoc())
    {
        array_push($employee_arr['data'],$row);
    }
    http_response_code(200);
    $employee_arr["status"] = 200;
    $employee_arr["messsage"]= "Login Successful";
    echo json_encode($employee_arr);
}
else
{
    http_response_code(200);
    $employee_arr["status"] = 400;
    $employee_arr["messsage"]= "Please Register Yourself";
    echo json_encode($employee_arr);
}

?>
