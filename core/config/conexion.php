<?php

class Conexion
{
  private static $pdo;
  private static $stmt;

  /**
   * CONECTA A LA BASE DE DATOS
   */
  public static function init()
  {
    require_once 'config.php';
    $options = [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];
    // CREA UN OBJETO PDO
    $base = new PDO('mysql:dbname='. DB .';host='. HOST .';charset=UTF8', USER, PASSWORD, $options);
    $base->exec('SET CHARSET UTF8');
    self::$pdo = $base;
  }

  /**
   * EJECUTA LAS CONSULTAS A LA DB
   */
  public static function query($sql, $data = array(), $select = false, $one = false) {
    $exec = self::$pdo->prepare($sql);
    $exec->execute($data);

    // SI ES CONSULTA SELECT
    if ($select) {
      // SI ES SOLO UN RESULTADO
      if ($one) {
        return $exec->fetch(PDO::FETCH_ASSOC);
      }
      return $exec->fetchAll(PDO::FETCH_ASSOC);
    }
    self::$stmt = $exec;
    return self::$stmt;
  }

  /**
   * OBTIENE EL ÚLTIMO ID INSERTADO
   */
  public static function lastInsertId() {
    return self::$pdo->lastInsertId();
  }

  /**
   * COMIENSA UNA TRANSACCIÓN
   */
  public static function beginTransaction() {
    self::$pdo->beginTransaction();
  }

  /**
   * COMMIT A LA TRANSACCIÓN
   */
  public static function commit() {
    self::$pdo->commit();
  }

  /**
   * ROLLBACK A LA TRANSACCIÓN
   */
  public static function rollBack() {
    self::$pdo->rollBack();
  }

  /**
   * DEVUELVE EL NÚMERO DE COLUMNAS AFECTADAS
   */
  public static function rowCount() {
    self::$stmt->rowCount();
  }
}
// INSTACÍA LA CONEXION UNA SOLA VEZ
Conexion::init();