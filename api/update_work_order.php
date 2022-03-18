<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/work_order.php';

$database = new Database();
$db = $database->get_connection();
$items = new WorkOrder($db);



if (empty($_FILES)) {
    //$_POST = json_decode(file_get_contents('php://input'), true);
    //print_r($_POST['designer_head']);die;
    $items->id=$_POST['id'];
    $items->purchase_order = $_POST['purchase_order'];
    $items->designer_head = $_POST['designer_head'];
    $items->designer_head_description_status = json_encode($_POST['designer_head_description_status']);
    // $items->designer_head_approval_by_crm_operator = $_POST['designer_head_approval_by_crm_operator'];
    // $items->designer_head_approval_by_super_admin = $_POST['designer_head_approval_by_super_admin'];
    // $items->designer_head_file = $_POST['designer_head_file'];
    $items->designer = $_POST['designer'];
    $items->designer_description_status = json_encode($_POST['designer_description_status']);
    // $items->designer_approval_by_designer_head = $_POST['designer_approval_by_designer_head'];
    // $items->designer_file = $_POST['designer_file'];
    $items->programmer = $_POST['programmer'];
    $items->programmer_description_status = json_encode($_POST['programmer_description_status']);
    // $items->programmer_approval_by_designer = $_POST['programmer_approval_by_designer'];
    // $items->programmer_approval_by_designer_head = $_POST['programmer_approval_by_designer_head'];
    // $items->programmer_file = $_POST['programmer_file'];
    $items->machine_operator = $_POST['machine_operator'];
    $items->machine_operator_description_status = json_encode($_POST['machine_operator_description_status']);
    // $items->machine_operator_approval_by_designer = $_POST['machine_operator_approval_by_designer'];
    // $items->machine_operator_file = $_POST['machine_operator_file'];
    $items->machine_operator_parameter = json_encode($_POST['machine_operator_parameter']);
    $items->transporter = $_POST['transporter'];
    $items->transporter_description_status = json_encode($_POST['transporter_description_status']);
    // $items->transporter_approval_by_crm_operator = $_POST['transporter_approval_by_crm_operator'];
    // $items->transporter_file = $_POST['transporter_file'];
    $create_third_party = $items->update_work_order();
    $response_arr = array();
    if ($create_third_party) {
        http_response_code(200);
        $response_arr["status"] = 200;
        $response_arr["messsage"] = "Work Order updated successfully";
        echo json_encode($response_arr);
    } else {
        http_response_code(404);
        $response_arr["status"] = 404;
        $response_arr["messsage"] = "Work Order could not be updated.";
        echo json_encode($response_arr);
    }
}
else
{
    $upload_path = 'C:/xampp/htdocs/girnar_backend/assets/images/'; // set upload folder path
    if(empty($_FILES["designer_head_file"]))
	{
		$fileName1="";
	}
    else
    {
        $fileName1 = $uniqueid  . '_' . basename($_FILES["designer_head_file"]["name"]);
        $tempPath1  =  $_FILES['designer_head_file']['tmp_name'];
        $fileSize1  =  $_FILES['designer_head_file']['size'];
        move_uploaded_file($tempPath1, $upload_path . $fileName1);
    }
    if(empty($_FILES["designer_file"]))
	{
		$fileName2="";
	}
    else
    {
        $fileName2 = $uniqueid  . '_' . basename($_FILES["designer_file"]["name"]);
	    $tempPath2  =  $_FILES['designer_file']['tmp_name'];
	    $fileSize2  =  $_FILES['designer_file']['size'];
        move_uploaded_file($tempPath2, $upload_path . $fileName2);
    }
    if(empty($_FILES["programmer_file"]))
	{
		$fileName3="";
	}
    else
    {
        $fileName3 = $uniqueid  . '_' . basename($_FILES["programmer_file"]["name"]);
        $tempPath3  =  $_FILES['programmer_file']['tmp_name'];
        $fileSize3  =  $_FILES['programmer_file']['size'];    
        move_uploaded_file($tempPath3, $upload_path . $fileName3);
    }
    if(empty($_FILES["machine_operator_file"]))
	{
		$fileName4="";
	}
    else
    {
        $fileName4 = $uniqueid  . '_' . basename($_FILES["machine_operator_file"]["name"]);
	    $tempPath4  =  $_FILES['machine_operator_file']['tmp_name'];
	    $fileSize4  =  $_FILES['machine_operator_file']['size'];
        move_uploaded_file($tempPath4, $upload_path . $fileName4);
    }
    if(empty($_FILES["transporter_file"]))
	{
		$fileName5="";
	}
    else
    {
        $fileName5 = $uniqueid  . '_' . basename($_FILES["transporter_file"]["name"]);
        $tempPath5  =  $_FILES['transporter_file']['tmp_name'];
        $fileSize5  =  $_FILES['transporter_file']['size'];
        move_uploaded_file($tempPath5, $upload_path . $fileName5);
    }
    //$_POST = json_decode(file_get_contents('php://input'),true);
    //print_r($_POST['designer_head']);die;
    $items->id=$_POST['id'];
    $items->purchase_order = $_POST['purchase_order'];
    
    $items->designer_head = $_POST['designer_head'];
    $items->designer_head_description_status = json_encode($_POST['designer_head_description_status']);
    // $items->designer_head_approval_by_crm_operator = $_POST['designer_head_approval_by_crm_operator'];
    // $items->designer_head_approval_by_super_admin = $_POST['designer_head_approval_by_super_admin'];
    $items->designer_head_file = $fileName1;
    $items->designer = $_POST['designer'];
    $items->designer_description_status = json_encode($_POST['designer_description_status']);
    // $items->designer_approval_by_designer_head = $_POST['designer_approval_by_designer_head'];
    $items->designer_file = $fileName2;
    $items->programmer = $_POST['programmer'];
    $items->programmer_description_status = json_encode($_POST['programmer_description_status']);
    // $items->programmer_approval_by_designer = $_POST['programmer_approval_by_designer'];
    // $items->programmer_approval_by_designer_head = $_POST['programmer_approval_by_designer_head'];
    $items->programmer_file = $fileName3;
    $items->machine_operator = $_POST['machine_operator'];
    $items->machine_operator_description_status = json_encode($_POST['machine_operator_description_status']);
    // $items->machine_operator_approval_by_designer = $_POST['machine_operator_approval_by_designer'];
    $items->machine_operator_file = $fileName4;
    $items->machine_operator_parameter = json_encode($_POST['machine_operator_parameter']);
    $items->transporter = $_POST['transporter'];
    $items->transporter_description_status = json_encode($_POST['transporter_description_status']);
    // $items->transporter_approval_by_crm_operator = $_POST['transporter_approval_by_crm_operator'];
    $items->transporter_file = $fileName5;
    $create_third_party=$items->update_work_order_with_files();
    $response_arr = array();
    if($create_third_party)
    {
        http_response_code(200);
        $response_arr["status"]=200;
        $response_arr["messsage"] = "Work Order updated successfully";
        echo json_encode($response_arr);
    }
    else
    {
        http_response_code(404);
        $response_arr["status"] = 404;
        $response_arr["messsage"]= "Work Order could not be updated.";
        echo json_encode($response_arr);
    }  
}
