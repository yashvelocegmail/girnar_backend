<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/employee_and_user.php';


$uniqueid = uniqid();
$database = new Database();
$db = $database->get_connection();
$items = new Employee($db);

if(empty($_FILES))
{
  //$_POST = json_decode(file_get_contents('php://input'),true);
  $items->id = $_POST['id'];
  $items->name = $_POST['name'];
  $items->email = $_POST['email'];
  $items->mobile = $_POST['mobile'];
  $items->address = $_POST['address'];
  $items->position = $_POST['position'];
  $items->adhaar_no = $_POST['adhaar_no'];
  $items->pan_no = $_POST['pan_no'];
  $items->username = $_POST['username'];
  $items->password = $_POST['password'];
  $items->user_type = $_POST['user_type'];
  $items->bank_name = $_POST['bank_name'];
  $items->branch = $_POST['branch'];
  $items->ifsc = $_POST['ifsc'];
  $items->account_no = $_POST['account_no'];
  $items->salary = $_POST['salary'];

  $response = $items->update_employee_without_photo();
  $response_arr=array();
  if($response)
  {
      http_response_code(200);
      $response_arr['message'] = "Employee updated successfully";
      echo json_encode($response_arr);
  }
  else
  {
      http_response_code(200);
      $response_arr['message'] = "Employee cannot updated";
      echo json_encode($response_arr);
  }
}
else
{
  $fileName = $uniqueid  . '_' . basename($_FILES["photo"]["name"]);
  $tempPath  =  $_FILES['photo']['tmp_name'];
  $fileSize  =  $_FILES['photo']['size'];


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
    $items->name = $_POST['name'];
    $items->email = $_POST['email'];
    $items->mobile = $_POST['mobile'];
    $items->address = $_POST['address'];
    $items->position = $_POST['position'];
    $items->adhaar_no = $_POST['adhaar_no'];
    $items->pan_no = $_POST['pan_no'];
    $items->username = $_POST['username'];
    $items->password = $_POST['password'];
    $items->user_type = $_POST['user_type'];
    $items->bank_name = $_POST['bank_name'];
    $items->branch = $_POST['branch'];
    $items->ifsc = $_POST['ifsc'];
    $items->account_no = $_POST['account_no'];
    $items->photo = $fileName;
    $items->salary = $_POST['salary'];

    $response = $items->update_employee_with_photo();
    $response_arr=array();
    if($response)
    {
        http_response_code(200);
        $response_arr['message'] = "Employee updated successfully";
        echo json_encode($response_arr);
    }
    else
    {
        http_response_code(200);
        $response_arr['message'] = "Employee cannot updated";
        echo json_encode($response_arr);
    }
}
