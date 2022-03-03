<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/leave_tracker.php';

$uniqueid = uniqid();

$database = new Database();
$db = $database->get_connection();
$items = new LeaveTracker($db);
//print_r($_FILES);die;
if(empty($_FILES))
{
  //$_POST = json_decode(file_get_contents('php://input'),true);
  $items->id = $_POST['id'];
  $items->employee = $_POST['employee'];
  $items->leave_from = $_POST['leave_from'];
  $items->leave_to = $_POST['leave_to'];
  $items->reason = $_POST['reason'];
  $items->approval = $_POST['approval'];
  $items->applied_on = $_POST['applied_on'];

  $response = $items->update_leave_tracker_hr_without_attachment();
  $response_arr=array();
  if($response)
  {
      http_response_code(200);
      $response_arr['message'] = "Leave updated successfully";
      echo json_encode($response_arr);
  }
  else
  {
      http_response_code(200);
      $response_arr['message'] = "Leave cannot updated";
      echo json_encode($response_arr);
  }
}
else
{
  $fileName = $uniqueid  . '_' . basename($_FILES["attachment"]["name"]);
  $tempPath  =  $_FILES['attachment']['tmp_name'];
  $fileSize  =  $_FILES['attachment']['size'];


    $upload_path = 'C:/xampp/htdocs/girnar_backend/assets/images/'; // set upload folder path

    $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

    // allow valid image file formats
    if(in_array($fileExt, $valid_extensions))
    {
      //check file not exist our upload folder path
      if(!file_exists($upload_path . $fileName))
      {
        // check file size '5MB'
        if($fileSize < 5000000){
          move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path
        }
        else{
          $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
          echo $errorMSG;
        }
      }
      else
      {
        $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));
        echo $errorMSG;
      }
    }
    else
    {
      $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));
      echo $errorMSG;
    }
    $data_entity = json_decode(file_get_contents('php://input'),true);
    $items->id = $_POST['id'];
    $items->id = $_POST['id'];
    $items->employee = $_POST['employee'];
    $items->leave_from = $_POST['leave_from'];
    $items->leave_to = $_POST['leave_to'];
    $items->reason = $_POST['reason'];
    $items->approval = $_POST['approval'];
    $items->applied_on = $_POST['applied_on'];
    $items->attachment = $fileName;

    $response = $items->update_leave_tracker_hr_with_attachment();
    $response_arr=array();
    if($response)
    {
        http_response_code(200);
        $response_arr['message'] = "Leave updated successfully";
        echo json_encode($response_arr);
    }
    else
    {
        http_response_code(200);
        $response_arr['message'] = "Leave cannot updated";
        echo json_encode($response_arr);
    }
}
