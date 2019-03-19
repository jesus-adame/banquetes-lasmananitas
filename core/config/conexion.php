<?php
class Conexion
{
  /**------- CONECTA A LA BASE DE DATOS --------*/
  public static function conectar()
  {
    require_once 'config.php';
    $options = [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];

    $base = new PDO('mysql:dbname='. DB .';host='. HOST .';charset=UTF8', USER, PASSWORD, $options);
    $base->exec('SET CHARSET UTF8');
    return $base;
  }

  /**-------- EJECUTA LAS CONSULTAS A LA DB ----------*/
  static function query($sql, $data = array(), $select = false, $one = false) {
    $stmt = self::conectar();
    $exec = $stmt->prepare($sql);
    $exec->execute($data);
    
    /**----- SI ES CONSULTA SELECT -------*/
    if ($select) {
      /**------ SI ES SOLO UN RESULTADO -------*/
      if ($one) {
        return $exec->fetch(PDO::FETCH_ASSOC);

      } else {
        return $exec->fetchAll(PDO::FETCH_ASSOC);
      }
    } else {
      return $stmt;
    }
  }
}
?>