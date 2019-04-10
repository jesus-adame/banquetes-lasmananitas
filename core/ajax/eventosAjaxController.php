<?php header('Content-type: application/json');
session_start();
include '../models/EventosModel.php';
include '../models/TablasModel.php';
require_once '../config/conexion.php';
$event = new Evento();
$tabla_event = new Tabla('eventos');

$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : 'leer';

// TODO: ACTUALIZAR EL MANEJO DE RESPUESTAS EN JSON
switch ($accion) {
  case 'agregar':
    if (!empty($_POST['title']) && !empty($_POST['evento']) &&
      !empty($_POST['contacto']) && !empty($_POST['personas'])) {

      $res = $event->agregarEvento();
    } else {
      $res = 'empty_fields';
    }

    echo json_encode($res);
    break;

  case 'modificar':
    if (!empty($_POST['id']) && !empty($_POST['title']) &&
      !empty($_POST['evento']) && !empty($_POST['contacto']) &&
      !empty($_POST['personas'])) {

      $res = $event->modificarEvento($_POST['id']);
      if ($res) {
        echo json_encode($res);
      } else {
        echo json_encode('not_user');
      }
    } else {
      echo json_encode('empty_fields');
    }
    break;

  case 'eliminar':
    // FIXME: MANEJAR LOS ERRORES DE SQL AL ELIMINAR UN EVENTO
    if (!empty($_POST['id'])) {
      $res = $event->eliminarEvento($_POST['id']);

      if ($res) {
        echo json_encode('success');
      } else {
        echo json_encode('not_user');
      }
    } else {
      echo 0;
    }
    break;

  default:
    $res = $tabla_event->obtener_datos_join('lugares', 'id_lugar');
    $tabla_event->setName('sub_evento');
    $sub_events = $tabla_event->obtener_datos();

    echo json_encode($res);
    break;
}
