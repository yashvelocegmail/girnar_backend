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

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->position = $_POST['position'];
$items->no_of_vacancies = $_POST['no_of_vacancies'];
$items->skills = $_POST['skills'];
$response = $items->update_vacancies();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Vacancies updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Vacancies thickness cannot updated";
    echo json_encode($response_arr);
}
