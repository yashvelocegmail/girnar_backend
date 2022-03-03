<?php
// Allow from any origin
// if (isset($_SERVER['HTTP_ORIGIN'])) {
//     header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//     header('Access-Control-Allow-Credentials: true');
//     header('Access-Control-Max-Age: 86400');    // cache for 1 day
// }
//
// // Access-Control headers are received during OPTIONS requests
// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//
//     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//
//     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//         header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//
//     exit(0);
// }
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/customer_and_user.php';

$database = new Database();
$db = $database->get_connection();
$items = new Customer($db);
$data_entity = json_decode(file_get_contents('php://input'), true);

$items->username = $data_entity['username'];
$items->password = $data_entity['password'];
$login_customer = $items->login_customer();
//print_r($login_customer);die;
$employee_arr=array();
$employee_arr['data'] = array();
if($login_customer->num_rows>0)
{
    while($row=$login_customer->fetch_assoc())
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
