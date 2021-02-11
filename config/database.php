<?php
  require __DIR__ . '../vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
class Database{

    // specify database credentials
    private $url;
    private $host;
    private $db_name;
    private $username;
    private $password;

    public function __construct() {
      $this->url = parse_url(getenv("DATABASE_URL"));
      $this->host = $url["host"];
      $this->db_name = substr($url["path"], 1);
      $this->username = $url["user"];
      $this->password = $url["pass"];
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
