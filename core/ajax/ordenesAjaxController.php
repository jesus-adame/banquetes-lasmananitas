<?php session_start();
header('Content-type: application/json');
include '../models/TablasModel.php';
include '../models/OrdenModel.php';
require_once '../config/conexion.php';
$tabla = new Tabla('ordenes_servicio');
$orden = new Orden();

// TODO: ACTUALIZAR EL MANEJO DE LAS RESPUESTAS
$accion = isset($_POST['accion']) ? $_POST['accion'] : 'leer';

switch ($accion) {
  case 'agregar':
    if (!empty($_POST['id_evento']) && !empty($_POST['nombre'])
    && !empty($_POST['lugar']) && !empty($_POST['montaje'])
    && !empty($_POST['garantia'])) {
      
      $lastInsertId = $orden->agregarOrden();
      
      if (isset($_POST['tag'])) {
        $tag = $_POST['tag'];
        $content = $_POST['content'];
        $ts = array();
        $cs = array();

        for ($i = 0; $i < sizeof($tag); $i++) {
          if ($tag[$i] !== '' && $content[$i] !== '') {
            $ts[] = $tag[$i];
            $cs[] = $content[$i];

            $orden->agregarCampoExtra($lastInsertId, $tag[$i], $content[$i]);
          }
        }
        
        if (empty($ts) || empty($cs))
        echo json_encode('No puede enviar campos extra vacios');

      }

      if ($lastInsertId) {
        echo json_encode('success');
      } else {
        echo json_encode('not_user');
      }
    } else {
      echo json_encode('empty_fields');
    }
    break;

  case 'modificar':
    if (!empty($_POST['id']) && !empty($_POST['nombre'])
    && !empty($_POST['lugar']) && !empty($_POST['montaje'])
    && !empty($_POST['garantia'])) {
      
      $res = $orden->modificarOrden($_POST['id']);
      
      if (isset($_POST['id_campo']) && isset($_POST['tag'])) {
        $id_campo = $_POST['id_campo'];
        $tag = $_POST['tag'];
        $content = $_POST['content'];

        for ($i = 0; $i < sizeof($id_campo); $i++) {
          $orden->editarCampoExtra($id_campo[$i], $tag[$i], $content[$i]);
        }
      }

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
      $res = $orden->eliminarOrden($_POST['id'], $_POST['id_evento']);

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
      $res = $tabla->obtener_datos_donde('id_orden', $_POST['id']);
      echo json_encode($res);
    } else {
      echo 0;
    }
    break;

  default:
    $res = $tabla->obtener_datos_donde('id_evento', $_POST['id']);

    echo json_encode($res);
    break;
}