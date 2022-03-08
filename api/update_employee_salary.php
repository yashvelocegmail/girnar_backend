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

$_POST = json_decode(file_get_contents('php://input'), true);
//print_r($_POST['editSalary']['id']);die;
$items->id = $_POST['id'];
$items->month = $_POST['month'];
$items->employee = $_POST['employee'];
$items->no_of_leaves = $_POST['no_of_leaves'];
$items->salary = $_POST['salary'];
$items->salary_deduction = $_POST['salary_deduction'];
$items->gross_salary = $_POST['gross_salary'];
$response = $items->update_employee_salary();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Employee salary updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Employee salary cannot updated";
    echo json_encode($response_arr);
}
