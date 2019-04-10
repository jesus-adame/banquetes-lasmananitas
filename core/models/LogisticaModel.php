<?php
class Logistica
{
  private $datos;

  public function __construct()
  {
    $this->datos = array();
  }

  /**--- AGREGAR LOGISTICA ---*/
  public function agregarLogistica($datos)
  {
    $data_log = array(
      'id_evento' => $datos[0],
      'start'     => $datos[1],
      'end'       => $datos[2], // FIXME: ELIMINAR ESTA LÍNEA
      'title'     => $datos[3],
      'lugar'     => $datos[4]
    );

    /** VALIDA EL AUTOR DEL EVENTO */
    if ($this->obtenerValidacionEvento($_SESSION['usuario']['id_usuario'], $datos[0])
    || $_SESSION['usuario']['rol'] == 'Administrador') {
      $validacion = true;

    } else { 
      $validacion = false;
    }

    /** VALIDA */
    if (!$validacion) {
      $_SESSION['error']['msg'] = 'No tiene permiso de editar este evento';
      return false;
    }
    
    $sql = "INSERT INTO sub_evento (id_evento, start, end, title, lugar)
    VALUES (:id_evento, :start, :end, :title, :lugar)"; // FIXME: ACTUALIZAR LA QUERY

    /** INSERTA LA ACTIVIDAD EN LA BASE DE DATOS */
    try {
      Conexion::query($sql, $data_log);

    } catch (\PDOException $th) {
      $_SESSION['error']['msg'] = $th->getMessage();
      return false;
    }
    return true;
  }

  /**--- ELIMINAR LOGISTICA ---*/
  public function eliminarLogistica($id, $id_evento)
  {
    /** VALIDA EL AUTOR DEL EVENTO */
    if ($this->obtenerValidacionEvento($_SESSION['usuario']['id_usuario'], $id_evento)
    || $_SESSION['usuario']['rol'] == 'Administrador') {
      $validacion = true;

    } else { 
      $validacion = false;
    }

    /** VALIDA */
    if (!$validacion) {
      $_SESSION['error']['msg'] = 'No tiene permiso de editar este evento';
      return false;
    }

    $sql = "DELETE FROM sub_evento WHERE id_sub_evento = :id";

    /** ELIMINA EL REGISTRO */
    $exe = Conexion::query($sql, array('id' => $id));
    return $exe;
  }

  /**--- MODIFICAR LOGISTICA ---*/
  public function modificarLogistica($id, $datos)
  {
    $data_log = array(
      'id_evento' => $datos[0],
      'start'     => $datos[1],
      'end'       => $datos[2],
      'title'     => $datos[3],
      'lugar'     => $datos[4],
      'id'        => $id
    );

    /** VALIDA EL AUTOR DEL EVENTO */
    if ($this->obtenerValidacionEvento($_SESSION['usuario']['id_usuario'], $datos[0])
    || $_SESSION['usuario']['rol'] == 'Administrador') {
      $validacion = true;

    } else { 
      $validacion = false;
    }

    /** VALIDA */
    if (!$validacion) {
      $_SESSION['error']['msg'] = 'No tiene permiso de editar este evento';
      return false;
    }

    $sql = "UPDATE sub_evento SET
    id_evento = :id_evento,
    start     = :start,
    end       = :end,
    title     = :title,
    lugar     = :lugar
    WHERE id_sub_evento = :id"; // FIXME: ACTUALIZAR LA QUERY

    /** ACTUALIZA LA ACTIVIDAD */
    $exe = Conexion::query($sql, $data_log);
    return $exe;    
  }

  /**--- VALIDA EL USUARIO ---*/
  private function obtenerValidacionEvento($id_usu, $id_evento)
  {
    $data = array(
      'id'        => $id_usu,
      'id_evento' => $id_evento
    );

    $sql = "SELECT id_usuario FROM eventos
    WHERE id_usuario = :id AND id_evento = :id_evento";

    $is_autor = Conexion::query($sql, $data, true);

    if (count($is_autor) > 1) {
      return 1;
    } return 0;
  }
}
