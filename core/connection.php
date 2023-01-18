<?php
require_once "const.php";
class Connection
{

  private $driver = "mysql";
  private $host = HOST;
  private $user = USER;
  private $password = PASSWORD;
  private $dbName = DB;
  private $charset = "utf8";
  protected function connect()
  {
    try {
      $pdo = new PDO("{$this->driver}:host={$this->host};dbname={$this->dbName};charset={$this->charset}", $this->user, $this->password);

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (\PDOException $e) {
      //echo $e->getMessage();
    }
  }
}
