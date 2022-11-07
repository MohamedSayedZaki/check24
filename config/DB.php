<?php
namespace App\Config;

use PDO;

class DB
{
  
  static private $_db = null;
  private function __construct() {}
  private function __clone() {}

  public static function getConnection()
  {
    $DB_HOST = $_ENV['MYSQL_HOST'];
    $DB_NAME = $_ENV['MYSQL_DATABASE'];
    $DB_USER = $_ENV['MYSQL_ROOT_USER'];
    $DB_PASS = $_ENV['MYSQL_ROOT_PASSWORD'];
    $DB_PORT = $_ENV['MYSQL_PORT'];
    
    if (self::$_db == null) {
      
      try {
      
        self::$_db = new PDO('mysql:host=' . $DB_HOST . ';port='.$DB_PORT.';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
        
        self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      } catch (PDOException $Exception) {
      
        throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );

        die('<h1>Sorry. The Database connection is temporarily unavailable.</h1>');
      }
      
      return self::$_db;
    }else {
      
      return self::$_db;
    }
  }

}