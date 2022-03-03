<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/third_party_task.php';

$uniqueid = uniqid();

$database = new Database();
$db = $database->get_connection();
$items = new ThirdPartyTask($db);

$fileName = $uniqueid  . '_' . basename($_FILES["file_upload"]["name"]);
$tempPath  =  $_FILES['file_upload']['tmp_name'];
$fileSize  =  $_FILES['file_upload']['size'];

if(empty($fileName))
{
  $errorMSG = json_encode(array("message" => "please select image", "status" => false));
  echo $errorMSG;
}
else
{
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
}

$items->third_party = $_POST['third_party'];
$items->task_details = $_POST['task_details'];
$items->file_upload = $fileName;
$items->time_required = $_POST['time_required'];
$items->remarks = $_POST['remarks'];

$third_party_task_created=$items->create_third_party_task();
$third_party_task=array();
if($third_party_task_created)
{
  http_response_code(200);
  $third_party_task["status"]=200;
  $third_party_task["messsage"] = "Third Party task created successfully";
  echo json_encode($third_party_task);
}
else
{
  http_response_code(200);
  $third_party_task["status"] = 404;
  $third_party_task["messsage"]= "Third Party task not be created.";
  echo json_encode($third_party_task);
}
