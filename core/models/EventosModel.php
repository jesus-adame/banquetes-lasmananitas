<?php
class Evento
{
  private $db;
  private $datos;

  public function __construct()
  {
    $this->db = Conexion::conectar();
    $this->datos = array();
  }

  public function agregarEvento($datos)
  {
    $sql = "INSERT INTO
    eventos (title, evento, contacto,
    cord_resp, cord_apoyo, description, id_lugar,
    start, end, personas, categoria, color, folio, id_usuario)
    VALUES (:title, :evento, :contacto,
      :cord_resp, :cord_apoyo, :des, :lugar,
      :start, :end, :personas, :categoria,
      :color, :folio, :id_usuario)";

    $exe = $this->db->prepare($sql);
    $exe->execute(array(
      'title' => $datos[0],
      'evento' => $datos[1],
      'contacto' => $datos[2],
      'cord_resp' => $datos[3],
      'cord_apoyo' => $datos[4],
      'des' => $datos[5],
      'lugar' => $datos[6],
      'start' => $datos[7],
      'end' => $datos[8],
      'personas' => $datos[9],
      'categoria' => $datos[10],
      'color' => $datos[11],
      'folio' => $datos[12],
      'id_usuario' => $_SESSION['id_usuario']
    ));

    return $exe;
  }

  public function eliminarEvento($id)
  {
    if ($this->obtenerValidacionEvento($_SESSION['id_usuario'], $id)
    || $_SESSION['puesto'] == 'Administrador' || $_SESSION['puesto'] == 'Supervisor') {

      $sql = "DELETE FROM
      eventos WHERE id_evento = :id";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'id' => $id
      ));

      return 1;
    } else { return 0; }
    
  }

  public function modificarEvento($id, $datos)
  {
    if ($this->obtenerValidacionEvento($_SESSION['id_usuario'], $id) == 1
    || $_SESSION['puesto'] == 'Administrador' || $_SESSION['puesto'] == 'Supervisor') {

      $sql = "UPDATE eventos SET
      title = :title, evento = :evento, contacto = :contacto,
      cord_resp = :cord_resp, cord_apoyo = :cord_apoyo,
      description = :des, id_lugar = :lugar, start = :start,
      end = :end, personas = :personas,
      categoria = :categoria, color = :color, folio = :folio
      WHERE id_evento = :id";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'title' => $datos[0],
        'evento' => $datos[1],
        'contacto' => $datos[2],
        'cord_resp' => $datos[3],
        'cord_apoyo' => $datos[4],
        'des' => $datos[5],
        'lugar' => $datos[6],
        'start' => $datos[7],
        'end' => $datos[8],
        'personas' => $datos[9],
        'categoria' => $datos[10],
        'color' => $datos[11],
        'folio' => $datos[12],
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
