<?php
class Conexion
{
  public static function conectar()
  {
    require_once 'config.php';
    $base = new PDO('mysql:dbname='. DB .';host='. HOST .';charset=UTF8', USER, PASSWORD);

    return $base;
  }

  static function query($sql, $data = array(), $select, $one) {
    $stmt = self::conectar();
    $exec = $stmt->prepare($sql);
    $exec->execute($data);

    if ($select) {
      if ($one) {
        return $exec->fetch(PDO::FETCH_ASSOC);
      } else {
        return $exec->fetchAll(PDO::FETCH_ASSOC);
      }
    } else {
      return true;
    }
  }
}
?>