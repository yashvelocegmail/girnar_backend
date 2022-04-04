<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/material_grade.php';

$database = new Database();
$db = $database->get_connection();
$items = new MaterialGrade($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $_POST = json_decode(file_get_contents('php://input'),true);

$items->material_grade = $_POST['material_grade'];
$create_material_grade=$items->create_material_grade();
$response_arr = array();
if($create_material_grade)
{
    http_response_code(200);
    $response_arr["status"]=200;
    $response_arr["messsage"] = "Material grade created successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(404);
    $response_arr["status"] = 404;
    $response_arr["messsage"]= "Material grade could not be created.";
    echo json_encode($response_arr);
}

}
