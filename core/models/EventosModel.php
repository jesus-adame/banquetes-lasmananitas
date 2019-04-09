<?php
class Evento
{
  /** CREA UN ARRAY DE LOS DATOS */
  private function getArrayData()
  {
    $cord_resp = isset($_POST['cord_resp']) ? $_POST['cord_resp'] :
    $_SESSION['usuario']['nombre'].  ' ' .$_SESSION['usuario']['apellidos'];

    return array(
      'title'      => $_POST['title'],
      'evento'     => $_POST['evento'],
      'folio'      => isset($_POST['folio']) ? $_POST['folio'] : '',
      'contacto'   => $_POST['contacto'],
      'cord_resp'  => strtoupper($cord_resp),
      'cord_apoyo' => isset($_POST['cord_apoyo']) ? $_POST['cord_apoyo'] : '',
      'des'        => isset($_POST['description']) ? $_POST['description'] : '',
      'lugar'      => $_POST['id_lugar'],
      'start'      => $_POST['start'],
      'end'        => $_POST['end'],
      'personas'   => $_POST['personas'],
      'categoria'  => $_POST['categoria'],
      'color'      => $_POST['color']
    );
  }

  /**------ INSERTA EL EVENTO ---------*/
  public function agregarEvento()
  {
    $data               = $this->getArrayData();
    $data['id_usuario'] = $_SESSION['usuario']['id_usuario'];

    $sql = "INSERT INTO eventos VALUES (
      null, :title, :evento, :folio, :contacto, :cord_resp,
      :cord_apoyo, :des, :lugar, :start, :end, :personas,
      :categoria, :color, :id_usuario)";

    $agregar = Conexion:: query($sql, $data);

    return $agregar;
  }

  /**---------- ELIMINA EL EVENTO ---------*/
  public function eliminarEvento($id)
  {
    $error = true;
    $validacion = $this->obtenerValidacionEvento($_SESSION['usuario']['id_usuario'], $id);

    /** VALIDA EL ACCESO A LA FUNCIONALIDAD */
    if ($validacion || $_SESSION['usuario']['rol'] == 'Administrador' || $_SESSION['usuario']['rol'] == 'Supervisor') {
      $error = false;
    }

    if ($error == true) {
      $_SESSION['error']['msg'] = 'No tiene permiso de eliminar este evento';
      return false;
    }

    $sql = "DELETE FROM eventos WHERE id_evento = :id";

    try {
      Conexion::query($sql, array('id' => $id));

    } catch (\Throwable $th) {
      $_SESSION['error']['msg'] = $th->getMessage();
    }
    return true;
  }

  /**------ MODIFICA EL EVENTO --------*/
  public function modificarEvento($id)
  {
    $data       = $this->getArrayData();
    $data['id'] = $id;

    if ($this->obtenerValidacionEvento($_SESSION['usuario']['id_usuario'], $id) == 1 ||
      $_SESSION['usuario']['rol'] == 'Administrador' || $_SESSION['usuario']['rol'] == 'Supervisor') {

      $sql = "UPDATE eventos SET
      title = :title, evento = :evento, contacto = :contacto,
      cord_resp = :cord_resp, cord_apoyo = :cord_apoyo,
      description = :des, id_lugar = :lugar, start = :start,
      end = :end, personas = :personas, categoria = :categoria,
      color = :color, folio = :folio WHERE id_evento = :id";

      $editar = Conexion::query($sql, $data);
      return $editar;

    } else { return false; }
  }

  /**----- VALIDA EL AUTOR DEL EVENTO ----*/
  private function obtenerValidacionEvento($id_usu, $id_evento)
  {
    $data = array(
      'id'        => $id_usu,
      'id_evento' => $id_evento
    );

    $sql = "SELECT id_usuario FROM eventos
    WHERE id_usuario = :id AND id_evento = :id_evento";

    try {
      $is_autor = Conexion::query($sql, $data, true);

    } catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
      return false;
    }

    if (count($is_autor) < 1) {
      return false;
    } else { return true; }
  }
}
