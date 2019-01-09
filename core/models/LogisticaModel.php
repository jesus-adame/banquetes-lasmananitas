<?php
class Logistica
{
  private $db;
  private $datos;

  public function __construct()
  {
    $this->db = Conexion::conectar();
    $this->datos = array();
  }

  public function agregarLogistica($datos)
  {
    if ($this->obtenerValidacionEvento($_SESSION['id_usuario'], $datos[0])
    || $_SESSION['puesto'] == 'Administrador') {
      $sql = "INSERT INTO
      sub_evento (id_evento, start, end,
      title, lugar)
      VALUES (:id_evento, :start, :end,
        :title, :lugar)";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'id_evento' => $datos[0],
        'start' => $datos[1],
        'end' => $datos[2],
        'title' => $datos[3],
        'lugar' => $datos[4]
      ));

      return $exe;
    } else { return 0; }
    
  }

  public function eliminarLogistica($id, $id_evento)
  {
    if ($this->obtenerValidacionEvento($_SESSION['id_usuario'], $id_evento)
    || $_SESSION['puesto'] == 'Administrador') {
      $sql = "DELETE FROM
      sub_evento WHERE id_sub_evento = :id";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'id' => $id
      ));

      return $exe;
    } else { return 0; }
    
  }

  public function modificarLogistica($id, $datos)
  {
    if ($this->obtenerValidacionEvento($_SESSION['id_usuario'], $datos[0])
    || $_SESSION['puesto'] == 'Administrador') {
      $sql = "UPDATE sub_evento SET
      id_evento = :id_evento, start = :start, end = :end,
      title = :title, lugar = :lugar
      WHERE id_sub_evento = :id";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'id_evento' => $datos[0],
        'start' => $datos[1],
        'end' => $datos[2],
        'title' => $datos[3],
        'lugar' => $datos[4],
        'id' => $id
      ));

      return $exe;
    } else { return 0; }
    
  }

  private function obtenerValidacionEvento($id_usu, $id_evento)
  {
    $sql = "SELECT id_usuario FROM eventos
    WHERE id_usuario = :id AND id_evento = :id_evento";

    $exe = $this->db->prepare($sql);
    $exe->execute(array(
      'id' => $id_usu,
      'id_evento' => $id_evento
    ));

    if (count($exe->fetchAll()) >= 1) {
      return 1;
    } else { return 0; }
  }
}
