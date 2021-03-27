<?php
class Database {
  private $host;
  private $user;
  private $password; 
  private $dbname; 

  private $dbh;
  private $error;
  private $stmt;
  
  function __construct() {
    $this->host = getenv("DB_HOST");
    $this->user = getenv("DB_USER");
    $this->password = getenv("DB_PASSWORD");
    $this->dbname = getenv("DB_NAME");
    if(!($this->host && $this->user && $this->password && $this->dbname)) {
      die("Cannot connect to the database! Please specify the mandatory env variables and schema.");
    }
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
    } catch (PDOException $exception) {
      $this->error = $exception->getMessage();
    }
  }
}