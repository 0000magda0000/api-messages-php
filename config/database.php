<?php
class Database{

    // specify your own database credentials
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    private $host = $url["host"];
    private $db_name = substr($url["path"], 1);
    private $username = $url["user"];
    private $password = $url["pass"];
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
<?php

