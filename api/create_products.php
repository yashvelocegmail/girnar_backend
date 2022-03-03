<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../models/products.php';

$uniqueid = uniqid();

$database = new Database();
$db = $database->get_connection();
$items = new Products($db);

$fileName = $uniqueid  . '_' . basename($_FILES["product_file"]["name"]);
$tempPath  =  $_FILES['product_file']['tmp_name'];
$fileSize  =  $_FILES['product_file']['size'];

if(empty($fileName))
{
  $errorMSG = json_encode(array("message" => "please select image", "status" => false));
  echo $errorMSG;
}
else
{
  $upload_path = 'C:/xampp/htdocs/girnar_backend/assets/images/'; // set upload folder path

  $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
//echo $fileExt;die;
  // valid image extensions
  $valid_extensions = array('dwg','txt','jpeg', 'jpg', 'png', 'gif');

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

$items->product_name = $_POST['product_name'];
$items->available_stock = $_POST['available_stock'];
$items->uom = $_POST['uom'];
$items->price = $_POST['price'];
$items->product_file = $fileName;

$products_created=$items->create_products();
$products=array();
if($products_created)
{
  http_response_code(200);
  $products["status"]=200;
  $products["messsage"] = "Products created successfully";
  echo json_encode($products);
}
else
{
  http_response_code(404);
  $products["status"] = 404;
  $products["messsage"]= "Products could not be created.";
  echo json_encode($products);
}
