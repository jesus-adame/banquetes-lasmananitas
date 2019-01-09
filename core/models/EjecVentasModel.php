<?php
/*
  Esta clase tiene dos atributos:
  - id_empleado
  - db(la conexion)

  tambien tiene dos métodos:
  - agregarEvento()
  - agregarOrdenServicio()
*/
class EjecVentas
{
  private $id_empleado;
  private $db;

  public function __construct($id_empleado = null)
  {
    $this->id_empleado = $id_empleado;
    $this->db = Conexion::conectar();
  }

  public function agregarOrdenServicio($datos)
  {
    $sql = "INSERT INTO ordenes_servicio (
    no_pagina, fecha, nombre)
    VALUES (
    :no_page, :fecha, :nombre
    )";

    $exe = $this->db->prepare($sql);
    $exe->execute(array(
      'no_page' => $datos[0],
      'fecha' => $datos[1],
      'nombre' => $datos[2]
    ));

    return $exe;
  }
}
