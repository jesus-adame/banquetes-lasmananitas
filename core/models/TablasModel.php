<?php
/*
  Clase de tabla.
  Esta clase contiene tres atributo que son:
    - db (conexion)
    - datos (registros)
    - nombre (nombre de la tabla)

  Tambien contiene tres métodos que son:
    - obtener_datos()
    - obtener_datos_join($str[tabla2], $str[union], !str[campo], !str[valor])
    - obtener_registro($str[campo], $str[valor])

  Cada método tiene 0 o mas atributo obligatorios y 0 o mas
  atributos opcionales.

  $str[dato] = Atributo obligatorio de tipo cadena
  y el nombre del dato esperado.
  !str[datos] = Aributo opcional de tipo cadena.
*/
class Tabla
{
  private $db;
  private $datos;
  private $nombre;

  public function __construct($nombre = '')
  {
    $this->db = Conexion::conectar();
    $this->datos = array();
    $this->nombre = $nombre;
  }

  public function obtener_datos()
  {
    $sql = "SELECT * FROM $this->nombre";

    $exe = $this->db->prepare($sql);
    $exe->execute();

    while ($row = $exe->fetchAll(PDO::FETCH_ASSOC)) {
      $this->datos = $row;
    }

    return $this->datos;
  }

  public function obtener_datos_donde($campo, $valor)
  {
    $sql = "SELECT * FROM $this->nombre
    WHERE $campo = :$campo";

    $exe = $this->db->prepare($sql);
    $exe->execute(array("$campo" => $valor));

    while ($row = $exe->fetchAll(PDO::FETCH_ASSOC)) {
      $this->datos = $row;
    }

    return $this->datos;
  }

  public function obtener_datos_join($tabla2, $on, $campo = '', $value = '')
  {
    if ($campo == '' || $value == '') {

      $sql = "SELECT * FROM $this->nombre
      INNER JOIN $tabla2 ON $this->nombre.$on = $tabla2.$on";

      $exe = $this->db->prepare($sql);
      $exe->execute();
    } else if (!empty($campo) && !empty($value)) {

      $sql = "SELECT * FROM $this->nombre
      INNER JOIN $tabla2 ON $this->nombre.$on = $tabla2.$on
      WHERE $this->nombre.$campo = :$campo";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        $campo => $value
      ));
    } else {
      return 0;
    }

    while ($row = $exe->fetchAll(PDO::FETCH_ASSOC)) {
      $this->datos = $row;
    }

    return $this->datos;
  }

  public function obtener_datos_left_join($tabla2, $on, $campo = '', $value = '')
  {
    if ($campo == '' || $value == '') {

      $sql = "SELECT * FROM $this->nombre
      LEFT JOIN $tabla2 ON $this->nombre.$on = $tabla2.$on";

      $exe = $this->db->prepare($sql);
      $exe->execute();
    } else if (!empty($campo) && !empty($value)) {

      $sql = "SELECT * FROM $this->nombre
      LEFT JOIN $tabla2 ON $this->nombre.$on = $tabla2.$on
      WHERE $this->nombre.$campo = :$campo";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        $campo => $value
      ));
    } else {
      return 0;
    }

    while ($row = $exe->fetchAll(PDO::FETCH_ASSOC)) {
      $this->datos = $row;
    }

    return $this->datos;
  }

  public function setName($tabla)
  {
    $this->datos = array();
    $this->nombre = $tabla;
  }

  public function __destruct()
  {
    $this->nombre;
    $this->datos;
    $this->db;
  }
}
