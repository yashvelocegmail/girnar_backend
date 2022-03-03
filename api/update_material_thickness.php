<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/material_thickness.php';

$database = new Database();
$db = $database->get_connection();
$items = new MaterialThickness($db);

$_POST = json_decode(file_get_contents('php://input'), true);
$items->id = $_POST['id'];
$items->material_thickness = $_POST['material_thickness'];
$response = $items->update_material_thickness();
$response_arr=array();
if($response)
{
    http_response_code(200);
    $response_arr['message'] = "Material thickness updated successfully";
    echo json_encode($response_arr);
}
else
{
    http_response_code(200);
    $response_arr['message'] = "Material thickness cannot updated";
    echo json_encode($response_arr);
}
