<?php
class DB
{
  private static function connect()
  {

    $dbhost = '127.0.0.1';
    $dbname = 'simple_deploy_api';
    $dbuser = 'root';
    $dbpass = '';

    $mysql_connect_str = 'mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=utf8';
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try {
      $pdo = new PDO($mysql_connect_str, $dbuser, $dbpass, $options);
    } catch (PDOException $e) {
      return $e->getMessage();
    }

    return $pdo;
  }

  public static function query($query, $params = array())
  {
    $statement = self::connect()->prepare($query);
    $statement->execute($params);

    if (explode(' ', $query)[0] == 'SELECT') {
      $data = $statement->fetchAll();
      return $data;
    }
  }
  public static function simple_connect()
  {
    $dbhost = '127.0.0.1';
    $dbname = 'renian_call';
    $dbuser = 'root';
    $dbpass = '';
    $mysql_connect_str = 'mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=utf8';
    $options = array();
    try {
      $pdo = new PDO($mysql_connect_str, $dbuser, $dbpass, $options);
    } catch (PDOException $e) {
      return $e->getMessage();
    }

    return $pdo;
  }
  public static function countRecords($query, $params = array())
  {
    $statement = self::connect()->prepare($query);
    $statement->execute($params);

    if (explode(' ', $query)[0] == 'SELECT') {
      $data = $statement->fetchAll();
      return $statement->rowCount();
    }
  }
}