<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/employee_salary.php';

$database = new Database();
$db = $database->get_connection();
$items = new EmployeeSalary($db);

$_POST = json_decode(file_get_contents('php://input'),true);

$items->employee = $_POST['employee'];
$items->no_of_leaves = $_POST['no_of_leaves'];
$items->month = $_POST['month'];
$items->salary = $_POST['salary'];
$items->salary_deduction = $_POST['salary_deduction'];
$items->gross_salary = $_POST['gross_salary'];
$create_employee_salary=$items->create_employee_salary();
$response_arr = array();
if($create_employee_salary)
{
    http_response_code(200);
    $response_arr["status"]=200;
    $response_arr["messsage"] = "Employee salary created successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(404);
    $response_arr["status"] = 404;
    $response_arr["messsage"]= "Employee salary could not be created.";
    echo json_encode($response_arr);
}
