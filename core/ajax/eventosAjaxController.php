<?php
session_start();
include '../models/EventosModel.php';
include '../models/TablasModel.php';
require_once '../config/conexion.php';
$event = new Evento();
$tabla_event = new Tabla('eventos');

$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : 'leer';
$res = array(
  'error' => true
);

switch ($accion) {
  case 'agregar':
    /** VALIDA LOS DATOS POR POST */
    if (empty($_POST['title']) || empty($_POST['evento']) ||
      empty($_POST['contacto']) || empty($_POST['personas'])) {
      $res['msg']   = '<h3>Datos incorrectos</h3><br>Debe llenar los campos obligatorios (*)';
      $res['error'] = true;
      break;
    }

    // VALIDAR FECHAS
    $validacion = $event->validarFechas($_POST['start'], $_POST['end']);
    if (!$validacion) {
      $res['msg']   = '<h3>Datos incorrectos</h3><br>No pueden haber fechas vacias';
      $res['error'] = true;
      break;
    }
    
    try {
      /** AGREGA EL EVENTO */
      $event->agregarEvento();
      $res['error'] = false;

    } catch (\PDOException $th) {
      $res['msg']   = 'No se pudo agregar el evento';
      $res['error'] = true;
      $res['log']   = $th->getMessage();
    }
    break;

  case 'modificar':
    /** VALIDA LOS DATOS POR POST */
    if (empty($_POST['id']) || empty($_POST['title']) ||
      empty($_POST['evento']) || empty($_POST['contacto']) ||
      empty($_POST['personas'])) {
      $res['error'] = true;
      $res['msg']   = '<h3>Datos incorrectos</h3><br>Debe llenar los campos obligatorios (*)';
      break;
    }

    // VALIDAR FECHAS
    $validacion = $event->validarFechas($_POST['start'], $_POST['end']);
    if (!$validacion) {
      $res['msg']   = '<h3>Datos incorrectos</h3><br>No pueden haber fechas vacias';
      $res['error'] = true;
      break;
    }

    try {
      /** ACTUALIZA EL EVENTO */
      $event->modificarEvento($_POST['id']);
      $res['error'] = false;

    } catch (PDOException $th) {
      $res['error'] = true;
      /** MANEJO LOS ERRORES PERSONALIZADOS */
      if ($th->getCode() === 1010) {        
        $res['msg'] = $th->getMessage();
      } else {
        $res['msg'] = 'No se pudo modificar el evento';
      }
      $res['log'] = $th->getMessage();
    }
    break;

  case 'eliminar':
    if (empty($_POST['id'])) {
      $res['error'] = true;
      $res['msg'] = 'Faltan datos';
      break;
    }
    try {
      /** ELIMINA EL EVENTO */
      $event->eliminarEvento($_POST['id']);
      $res['error'] = false;

    } catch (\PDOException $th) {
      $res['error'] = true;
      $res['log']   = $th->getMessage();

      /** MANEJO EL ERROR SQL */
      if ($th->getCode() === '23000') {
        $res['msg'] = '<h3>Error</h3><br>No se puede eliminar porque contiene cotizaciones';

      } else if ($th->getCode() === 1010) {
        $res['msg'] = $th->getMessage();
      
      } else {
        $res['msg'] = 'No se pudo eliminar el evento';
      }  
    }
    break;

  default:
    $res = $tabla_event->obtener_datos_join('lugares', 'id_lugar');
    // FIXME: ElIMINAR ESTA RESPUESTA
    header('Content-type: aplication/json');
    echo json_encode($res);
    die();
    break;
}

header('Content-type: aplication/json');
echo json_encode($res);
