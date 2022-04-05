<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/employee_shift.php';

$database = new Database();
$db = $database->get_connection();
$items = new EmployeeShift($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_POST = json_decode(file_get_contents('php://input'), true);

    $items->shift = $_POST['shift'];
    $items->employee = $_POST['employee'];
    $items->position = $_POST['position'];
    $create_employee_shift = $items->create_emp_shift();
    

    $response_arr = array();

    if ($create_employee_shift) {
        if ($create_employee_shift == "duplicate entry") {
            http_response_code(200);
            $response_arr["status"] = 200;
            $response_arr["messsage"] = "Employee Already Allocated Shift";
            echo json_encode($response_arr);
        }
        else
        {
            http_response_code(200);
            $response_arr["status"] = 200;
            $response_arr["messsage"] = "Shift created successfully";
            echo json_encode($response_arr);
        }
    } else {
        http_response_code(404);
        $response_arr["status"] = 404;
        $response_arr["messsage"] = "Shift could not be created.";
        echo json_encode($response_arr);
    }
}
