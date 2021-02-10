<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../../config/database.php';
include_once '../objects/message.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate message object
$message = new message($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->content)
){
  
    // set message property values
    $message->content = $data->content;
    // $message->counter = $data->counter;
    // $message->uuid = $data->uuid;
    // $message->created = date('Y-m-d H:i:s');
    // $message->modified = date('Y-m-d H:i:s');

  
    // create the message
    if($message->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "message was created."));
    }
  
    // if unable to create the message, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create message."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create message. Data is incomplete."));
}
?>
