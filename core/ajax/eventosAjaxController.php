<?php header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
session_start();
include '../models/EventosModel.php';
include '../models/TablasModel.php';
require_once '../config/conexion.php';
$event = new Evento();
$tabla_event = new Tabla('eventos');

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'leer';

switch ($accion) {
  case 'agregar':
    if (!empty($_POST['title']) && !empty($_POST['evento']) && !empty($_POST['contacto'])
    && !empty($_POST['cord_resp']) && !empty($_POST['personas'])) {
      $datos = crearArrayDatos();

      $res = $event->agregarEvento($datos);
    } else {
      $res = 'empty_fields';
    }

    echo json_encode($res);
    break;

  case 'modificar':
    if (!empty($_POST['id']) && !empty($_POST['title'])
    && !empty($_POST['evento']) && !empty($_POST['contacto'])
    && !empty($_POST['cord_resp']) && !empty($_POST['personas'])) {
      $datos = crearArrayDatos();

      $res = $event->modificarEvento($_POST['id'], $datos);
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

function crearArrayDatos() {
  $d = array(
    $_POST['title'],
    $_POST['evento'],
    $_POST['contacto'],
    $_POST['cord_resp'],
    $_POST['cord_apoyo'],
    $_POST['description'],
    $_POST['id_lugar'],
    $_POST['start'],
    $_POST['end'],
    $_POST['personas'],
    $_POST['categoria'],
    $_POST['color'],
    $_POST['folio']
  );
  return $d;
}