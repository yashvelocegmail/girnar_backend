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
$fileName = $uniqueid  . '_' . basename($_FILES["photo"]["name"]);
$tempPath  =  $_FILES['photo']['tmp_name'];
$fileSize  =  $_FILES['photo']['size'];

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


//$_POST = json_decode(file_get_contents('php://input'),true);
//print_r($_POST);die;
$items->name = $_POST['name'];
$items->email = $_POST['email'];
$items->mobile = $_POST['mobile'];
$items->address = $_POST['address'];
$items->position = $_POST['position'];
$items->adhaar_no = $_POST['adhaar_no'];
$items->pan_no = $_POST['pan_no'];
$items->username = $_POST['username'];
$items->password = $_POST['password'];
// $items->user_type = $_POST['user_type'];
$items->bank_name = $_POST['bank_name'];
$items->branch = $_POST['branch'];
$items->ifsc = $_POST['ifsc'];
$items->account_no = $_POST['account_no'];
$items->photo = $fileName;
$items->salary = $_POST['salary'];


$read_employee=$items->read_single_employee();
//print_r($read_employee);die;
if($read_employee->affected_rows>0)
{
    http_response_code(200);
    $employee_arr["status"] = 404;
    $employee_arr["messsage"]= "Employee already exist";
    echo json_encode($employee_arr);die;
}

$user_created=$items->create_employee_user();
//print_r($user_created);die;
if ($user_created) {
    $items->users= $user_created;
    $employee_created=$items->create_employee();
    if($employee_created)
    {
        http_response_code(200);
        $employee_arr["status"]=200;
        $employee_arr["messsage"] = "Employee created successfully";
        echo json_encode($employee_arr);
    }
    else
    {
        http_response_code(404);
        $employee_arr["status"] = 404;
        $employee_arr["messsage"]= "Employee could not be created.";
        echo json_encode($employee_arr);
    }
}
else
{
    http_response_code(404);
    $employee_arr["status"] = 404;
    $employee_arr["messsage"]= "Employee could not be created.";
    echo json_encode($employee_arr);
}
