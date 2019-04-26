<?php header('Content-type: application/json');
session_start();
include '../models/TablasModel.php';
include '../models/LogisticaModel.php';
require_once '../config/conexion.php';
$tabla = new Tabla('sub_evento');
$logistica = new Logistica();

// TODO: ACTUALIZAR EL MANEJO DE RESPUESTAS
$accion = isset($_POST['accion']) ? $_POST['accion'] : 'leer';
$res = array(
  'error' => true
);

switch ($accion) {
  case 'agregar':
    if (empty($_POST['title'])) {
      $res['msg'] = 'Agregue un título';
      $res['error'] = true;
      break;
    }

    $datos = array(
      'id_evento' => $_POST['id_evento'],
      'start'     => $_POST['date_start'].' '.$_POST['time_start'],
      'title'     => $_POST['title'],
      'lugar'     => $_POST['lugar']
    );

    try {
      $res = $logistica->agregarLogistica($datos);
      $res['error'] = false;

    } catch (\Exception $e) {
      $res['error'] = true;

      if ($e->getCode() === 10) {
        $res['msg'] = $e->getMessage();

      } else {
        $res['msg'] = 'No se pudo agregar la actividad';
        $res['log'] = $e->getMessage();
      }
    }
    break;

  case 'modificar':
    if (empty($_POST['id']) || empty($_POST['title'])) {
      $res['msg'] = 'empty_fields';
      $res['error'] = true;
      break;
    }

    $datos = array(
      'id_evento' => $_POST['id_evento'],
      'start'     => $_POST['date_start'].' '.$_POST['time_start'],
      'title'     => $_POST['title'],
      'lugar'     => $_POST['lugar']
    );

    try {
      $res = $logistica->modificarLogistica($_POST['id'], $datos);
      $res['error'] = false;

    } catch (\PDOException $e) {
      $res['error'] = true;
      $res['msg'] = $e->getMessage();
    }
    break;

  case 'eliminar':
    if (empty($_POST['id'])) {
      $res['error'] = true;
      $res['msg'] = 'Faltan datos';
    }
    
    try {
      $logistica->eliminarLogistica($_POST['id'], $_POST['id_evento']);
      $res['error'] = false;
      
    } catch (PDOException $e) {
      $res['error'] = true;
      $res['msg'] = $e->getMessage();
    }
    break;

  case 'obtener':
    if (!empty($_POST['id'])) {
      $res = $tabla->obtener_datos_donde('id_sub_evento', $_POST['id']);

      echo json_encode($res);
      die();
    } else {
      echo 0;
      die;
    }
    break;

  default:
    $res = $tabla->obtener_datos_donde('id_evento', $_POST['id']);

    echo json_encode($res);
    die;
    break;
}

header('Content-type: aplication/json');
echo json_encode($res);
?>