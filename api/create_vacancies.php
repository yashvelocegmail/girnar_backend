<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/vacancies.php';

$database = new Database();
$db = $database->get_connection();
$items = new Vacancies($db);

$_POST = json_decode(file_get_contents('php://input'),true);

$items->position = $_POST['position'];
$items->no_of_vacancies = $_POST['no_of_vacancies'];
$items->skills = $_POST['skills'];
$create_third_party=$items->create_vacancies();
$response_arr = array();
if($create_third_party)
{
    http_response_code(200);
    $response_arr["status"]=200;
    $response_arr["messsage"] = "Vacancies created successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(404);
    $response_arr["status"] = 404;
    $response_arr["messsage"]= "Vacancies thickness could not be created.";
    echo json_encode($response_arr);
}
