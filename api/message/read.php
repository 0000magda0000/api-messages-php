<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../objects/message.php';

// instantiate database and message object
$database = new Database();
$db = $database->getConnection();

// initialize object
$message = new Message($db);

// query messages
$stmt = $message->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // messages array
    $messages_arr=array();
    $messages_arr["messages"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $message_item=array(
            "uuid" => $uuid,
        );

        array_push($messages_arr["messages"], $message_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show messages data in json format
    echo json_encode($messages_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no messages found
    echo json_encode(
        array("message" => "No messages found.")
    );
}
