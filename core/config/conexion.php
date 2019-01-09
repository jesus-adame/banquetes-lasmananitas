<?php
class Conexion
{
  public static function conectar()
  {
    require_once 'config.php';
    $base = new PDO('mysql:dbname='. DB .';host='. HOST .';charset=UTF8', USER, PASSWORD);

    return $base;
  }
}
?>