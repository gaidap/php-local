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

  function prepareQuery($query) {
    $this->stmt = $this->dbh->prepare($query);
  }

  private function determineParamType ($value) {
    $type;
    if (is_int($value)) {
      $type = PDO::PARAM_INT;
    } elseif (is_bool($value)) {
      $type = PDO::PARAM_BOOL;
    } elseif (is_string($value)) {
      $type = PDO::PARAM_STR;
    } else {
      $type = PDO::PARAM_NULL;
    }
    return $type;
  }

  function bindQueryParam($param, $value, $type = null) {
    if(is_null($type)) {
      $type = $this->determineParamType($value);
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  function excecuteQuery() {
    return $this->stmt->execute();
  }

  function fetchLastInsertId() {
    return $this->dbh->lastInsertId();
  }

  function resultSet() {
    $this->excecuteQuery();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}