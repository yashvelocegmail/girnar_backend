<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/customer_inquiry.php';


$uniqueid = uniqid();

// $customer = $_POST['customer'];
// $material_type = $_POST['material_type']; // collect input parameters and convert into readable format
// $material_thickness = $_POST['material_thickness'];
// $no_of_sheets = $_POST['no_of_sheets'];
// $material_grade = $_POST['material_grade'];
// $material_status = $_POST['material_status'];
// $material_status = $_POST['material_status'];
// $material_status = $_POST['material_status'];
// $description = $_POST['description'];
$database = new Database();
$db = $database->get_connection();
$items = new CustomerInquiry($db);
if(empty($_FILES))
{
  $data_entity = json_decode(file_get_contents('php://input'),true);

	$items->customer = $data_entity['customer'];
	$items->design_upload = $data_entity['design_upload'];

	$get_customer_inquiry=$items->get_customer_inquiry();
	while ($row = mysqli_fetch_assoc($get_customer_inquiry)) {
		$customer_name = $row["customer_name"];
	}
	//print_r($get_customer_inquiry);die;
	$items->inquiry=$customer_name."-Enquiry-".strval($get_customer_inquiry->num_rows+1);
	//print_r($items);die;
  $response = $items->create_customer_without_inquiry();
  $response_arr=array();
  if($response)
  {
      http_response_code(200);
      $response_arr['message'] = "Inquiry created successfully";
      echo json_encode($response_arr);
  }
  else
  {
      http_response_code(200);
      $response_arr['message'] = "Inquiry cannot created";
      echo json_encode($response_arr);
  }
 
}
else
{
	$fileName = $uniqueid  . '_' . basename($_FILES["design_upload"]["name"]);
	$tempPath  =  $_FILES['design_upload']['tmp_name'];
	$fileSize  =  $_FILES['design_upload']['size'];

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
	}




	$items->customer = $_POST['customer'];
	$items->material_type = $_POST['material_type'];
	$items->material_thickness = $_POST['material_thickness'];
	$items->material_grade = $_POST['material_grade'];
	$items->material_status = $_POST['material_status'];
	$items->type_of_process = $_POST['type_of_process'];
	$items->expected_delivery = $_POST['expected_delivery'];
	$items->design_upload = $fileName;
	$items->description = $_POST['description'];

	$get_customer_inquiry=$items->get_customer_inquiry();
	while ($row = mysqli_fetch_assoc($get_customer_inquiry)) {
		$customer_name = $row["customer_name"];
	}
	//print_r($get_customer_inquiry);die;
	$items->inquiry=$customer_name."-Enquiry-".strval($get_customer_inquiry->num_rows+1);
	
	$response_arr=array();

	if ($items->create_customer_inquiry())
	{
	    http_response_code(200);
	    $response_arr["status"]=200;
	    $response_arr["messsage"] = "Inquiry created successfully";
	    echo json_encode($response_arr);
	}
	else
	{
	    http_response_code(404);
	    $response_arr["status"] = 404;
	    $response_arr["messsage"]= "Inquiry could not be created.";
	    echo json_encode($response_arr);
	}

}

//$fileName  =  $_FILES['sendimage']['name'];
