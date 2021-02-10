<?php
class Message{

    // database connection and table name
    private $conn;
    private $table_name = "messages";

    // object properties
    public $uuid;
    public $content;
    public $counter;
    public $created;
    public $modified;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read messages
    function read(){

    // select all query
    $query = "SELECT *
            FROM
            " . $this->table_name . " ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}
    // create message
    function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                content=:content";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->content=htmlspecialchars(strip_tags($this->content));
  
    // bind values
    $stmt->bindParam(":content", $this->content);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

// used when filling up the update message form
function readOne(){
  
    // increment counter
    $increment = "UPDATE " . $this->table_name . "
                SET counter = counter + 1
                WHERE
                    uuid = ?";


    // query to read single record
    $query = "SELECT * 
            FROM " . $this->table_name . "
            WHERE
                uuid = ?";
                
    // prepare query statement and increment
    $stmt = $this->conn->prepare( $query );
    $incr = $this->conn->prepare( $increment );


    // bind uuid of message
    $stmt->bindParam(1, $this->uuid);
    $incr->bindParam(1, $this->uuid);

    // execute query and increment
    $stmt->execute();
    $incr->execute();

  
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->uuid = $row['uuid'];
    $this->content = $row['content'];
    $this->counter = $row['counter'];
    $this->created = $row['created'];
    $this->modified = $row['modified'];
}

// update the message
function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                content = :content
            WHERE
                uuid = :uuid";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->content=htmlspecialchars(strip_tags($this->content));
    $this->uuid=htmlspecialchars(strip_tags($this->uuid));

    // bind new values
    $stmt->bindParam(':uuid', $this->uuid);
    $stmt->bindParam(':content', $this->content);

    
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

// delete the message
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE uuid = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->uuid=htmlspecialchars(strip_tags($this->uuid));
  
    // bind uuid of record to delete
    $stmt->bindParam(1, $this->uuid);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
}
?>