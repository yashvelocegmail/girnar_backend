<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/customer_inquiry.php';

$uniqueid = uniqid();
//print_r($_FILES);die;
$database = new Database();
$db = $database->get_connection();
$items = new CustomerInquiry($db);
if(empty($_FILES))
{
  $data_entity = json_decode(file_get_contents('php://input'),true);
  $items->id = $_POST['id'];
  $items->customer = $_POST['customer'];
  $items->material_type = $_POST['material_type'];
  $items->material_thickness = $_POST['material_thickness'];
  $items->material_grade = $_POST['material_grade'];
  $items->material_status = $_POST['material_status'];
  $items->type_of_process = $_POST['type_of_process'];
  $items->expected_delivery = $_POST['expected_delivery'];
  $items->description = $_POST['description'];

  $response = $items->update_customer_inquiry_without_file();
  $response_arr=array();
  if($response)
  {
      http_response_code(200);
      $response_arr['message'] = "Inquiry updated successfully";
      echo json_encode($response_arr);
  }
  else
  {
      http_response_code(200);
      $response_arr['message'] = "Inquiry cannot updated";
      echo json_encode($response_arr);
  }
}
else
{
  $fileName = $uniqueid  . '_' . basename($_FILES["design_upload"]["name"]);
  $tempPath  =  $_FILES['design_upload']['tmp_name'];
  $fileSize  =  $_FILES['design_upload']['size'];


  	$upload_path = 'C:/xampp/htdocs/girnar_backend/assets/images/'; // set upload folder path

  	$fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension

  	// valid image extensions
  	$valid_extensions = array('dwg','jpeg', 'jpg', 'png', 'gif');

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
    $items->customer = $_POST['customer'];
    $items->material_type = $_POST['material_type'];
    $items->material_thickness = $_POST['material_thickness'];
    $items->material_grade = $_POST['material_grade'];
    $items->material_status = $_POST['material_status'];
    $items->type_of_process = $_POST['type_of_process'];
    $items->expected_delivery = $_POST['expected_delivery'];
    $items->design_upload = $fileName;
    $items->description = $_POST['description'];

    $response = $items->update_customer_inquiry();
    $response_arr=array();
    if($response)
    {
        http_response_code(200);
        $response_arr['message'] = "Inquiry updated successfully";
        echo json_encode($response_arr);
    }
    else
    {
        http_response_code(200);
        $response_arr['message'] = "Inquiry cannot updated";
        echo json_encode($response_arr);
    }
}
