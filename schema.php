<?php
$database = new Database();
$db = $database->getConnection();
private $conn;

try {
  public function __construct($db){
        $this->conn = $db;
    }

  $sql = "CREATE TABLE messages (
  uuid VARCHAR(36) DEFAULT (uuid()),
  content VARCHAR(255) NOT NULL,
  counter INT UNSIGNED DEFAULT NULL,
  created DATETIME NOT NULL DEFAULT NOW(),
  modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ( uuid )
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Database created successfully<br>";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

?>
