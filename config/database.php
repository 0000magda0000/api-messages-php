<?php
class Database{

    // specify database credentials
    private $host;
    private $db_name;
    private $username;
    private $password;

    public function __construct() {
      $this->host = getenv("DB_HOST_J");
      $this->db_name = getenv("DB_DATABASE_J");
      $this->username = getenv("DB_USERNAME_J");
      $this->password = getenv("DB_PASSWORD_J");
    }

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
