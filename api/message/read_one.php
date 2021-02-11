<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../../config/database.php';
include_once '../objects/message.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare message object
$message = new Message($db);

// set UUID property of record to read
$message->uuid = isset($_GET['uuid']) ? $_GET['uuid'] : die();

// read the details of message to be edited
$message->readOne();

if($message->uuid!=null){
    // create array
    $message_arr = array(
        "uuid" =>  $message->uuid,
        "content" => $message->content,
        "counter" => $message->counter,
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($message_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user message does not exist
    echo json_encode(array("message" => "message does not exist."));
}
?>
