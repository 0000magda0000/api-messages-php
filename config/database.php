<?php
class Database{

    // specify your own database credentials
    private $host = "us-cdbr-east-03.cleardb.com";
    private $db_name = "heroku_394a42a4b5cb062";
    private $username = "bbc08eb1da307f";
    private $password = "c478dc6e";
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