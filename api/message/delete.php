<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../../config/database.php';
include_once '../objects/message.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare message object
$message = new Message($db);
  
// get message uuid
$data = json_decode(file_get_contents("php://input"));
  
// set message uuid to be deleted
$message->uuid = $data->uuid;
  
// delete the message
if($message->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "message was deleted."));
}
  
// if unable to delete the message
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete message."));
}
?>