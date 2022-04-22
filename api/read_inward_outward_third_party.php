<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/inward_outward_third_party.php';

$database = new Database();
$db = $database->get_connection();
$items = new InwardOutward($db);

$records = $items->read_outward();
    $item_count = $records->num_rows;
    if($item_count>0)
    {
        $response_arr=array();
        $response_arr['data']=array();
        $response_arr['itemcount'] = $item_count;
        while($row=$records->fetch_assoc())
        {
            array_push($response_arr['data'],$row);
        }
        echo json_encode($response_arr);
    }
    else
    {
        http_response_code(200);
        $response_arr=array();
        $response_arr['data']=array();
        $response_arr['itemcount'] = $item_count;
        echo json_encode([]);
    }
