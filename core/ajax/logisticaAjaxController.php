<?php header('Content-type: application/json');
session_start();
include '../models/TablasModel.php';
include '../models/LogisticaModel.php';
require_once '../config/conexion.php';
$tabla = new Tabla('sub_evento');
$logistica = new Logistica();

$accion = isset($_POST['accion']) ? $_POST['accion'] : 'leer';

switch ($accion) {
  case 'agregar':
    if (!empty($_POST['title'])) {
      $datos = array(
        $_POST['id_evento'],
        $_POST['date_start'].' '.$_POST['time_start'],
        $_POST['date_end']. ' ' .$_POST['time_end'],
        $_POST['title'],
        $_POST['lugar']);
    } else {
      echo json_encode('empty_fields');
      break;
    }

    $res = $logistica->agregarLogistica($datos);
    if ($res) {
      echo json_encode('success');
    } else {
      echo json_encode('not_user');
    }
    break;

  case 'modificar':
    if (!empty($_POST['id']) && !empty($_POST['title'])) {
      $datos = array(
        $_POST['id_evento'],
        $_POST['date_start']. ' ' .$_POST['time_start'],
        $_POST['date_end']. ' ' .$_POST['time_end'],
        $_POST['title'],
        $_POST['lugar']);

      $res = $logistica->modificarLogistica($_POST['id'], $datos);
      if ($res) {
        echo json_encode('success');
      } else {
        echo json_encode('not_user');
      }
    } else {
      echo json_encode('empty_fields');
    }
    break;

  case 'eliminar':
    if (!empty($_POST['id'])) {
      $res = $logistica->eliminarLogistica($_POST['id'], $_POST['id_evento']);
      
      if ($res) {
        echo json_encode('success');
      } else {
        echo json_encode('not_user');
      }
    } else {
      echo 0;
    }
    break;

  case 'obtener':
    if (!empty($_POST['id'])) {
      $res = $tabla->obtener_datos_donde('id_sub_evento', $_POST['id']);

      echo json_encode($res);
    } else {
      return 0;
    }
    break;

  default:
    $res = $tabla->obtener_datos_donde('id_evento', $_POST['id']);

    echo json_encode($res);
    break;
}
