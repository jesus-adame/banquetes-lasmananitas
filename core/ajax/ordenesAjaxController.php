<?php

session_start();
header('Content-type: application/json');
include '../models/TablasModel.php';
include '../models/OrdenModel.php';
require_once '../config/conexion.php';
$tabla = new Tabla('ordenes_servicio');
$orden = new Orden();

$accion = isset($_POST['accion']) ? $_POST['accion'] : 'leer';
$res = array(
  'error' => true
);

switch ($accion) {
  case 'agregar':
    try {
      /** VALIDA LOS DATOS POST */
      if (empty($_POST['id_evento']) || empty($_POST['nombre'])
      || empty($_POST['lugar']) || empty($_POST['montaje'])
      || empty($_POST['garantia'])) {
        throw new Exception('Debe llenar los campos obligatorios');
      }

      /** VALIDA EL AUTOR DEL EVENTO */
      $valido = $orden->validaUsuarioEvento($_POST['id_evento']);

      if ($valido != '1' && $_SESSION['usuario']['rol'] != 'Administrador') {
        throw new Exception('No tiene permiso de editar este evento');
      }

      /** VALIDA LOS CAMPOS EXTRA */
      if (isset($_POST['tag'])) {
        $tag = $_POST['tag'];
        $content = $_POST['content'];

        for ($i = 0; $i < sizeof($tag); $i++) {
          if (empty($tag[$i]) || empty($content[$i])) {
            throw new Exception('No puede enviar campos extra vacios');
          }
        }
      }
    
      /** CAPTURA LOS ERRORES */
    } catch (Exception $e) {
      $res['error'] = true;
      $res['msg']   = $e->getMessage();

      header('Content-type: aplication/json');
      echo json_encode($res);
      die();
    }

    /** INSERTA LOS REGISTROS EN LA BASE DE DATOS */
    try {
      Conexion::beginTransaction();

      /** INSERTA UNA ORDEN DE SERVICIO */
      $orden->agregarOrden();
      $orden_id = Conexion::lastInsertId();
      
      if (isset($_POST['tag'])) {
        $tag = $_POST['tag'];
        $content = $_POST['content'];

        for ($i = 0; $i < sizeof($tag); $i++) {
          $orden->agregarCampoExtra($orden_id, $tag[$i], $content[$i]);
        }
      }
      /** CONFIRMA LOS CAMBIOS */
      Conexion::commit();
      $res['error'] = false;

      /** ATRAPA LOS ERRORES Y REVIERTE LOS CAMBIOS */
    } catch (PDOException $e) {
      $res['error'] = true;
      $res['msg']   = 'No se pudo registrar la orden';
      $res['code']  = $e->getCode();
      Conexion::rollBack();
    }
    /** DEVUELVE UNA RESPUESTA EN JSON */
    header('Content-type: aplication/json');
    echo json_encode($res);
    break;

  case 'modificar':
    /** VALIDA LOS DATOS POST */
    try {
      if (empty($_POST['id']) || empty($_POST['nombre'])
      || empty($_POST['lugar']) || empty($_POST['montaje'])
      || empty($_POST['garantia'])) {
        throw new Exception('Debe llenar los campos obligatorios');
      }

      $valido = $orden->validaUsuarioEvento($_POST['id_evento']);

      if (!$valido && $_SESSION['usuario']['rol'] != 'Administrador') {
        throw new Exception('No tiene permiso de editar este evento');
      }

      /** VALIDA LOS CAMPOS EXTRA */
      if (isset($_POST['tag'])) {
        $tag = $_POST['tag'];
        $content = $_POST['content'];

        for ($i = 0; $i < sizeof($tag); $i++) {
          if (empty($tag[$i]) || empty($content[$i])) {
            throw new Exception('No puede enviar campos extra vacios');
          }
        }
      }

    } catch (Exception $e) {
      $res['error'] = true;
      $res['msg']   = $e->getMessage();
      /** DEVUELVE UNA RESPUESTA EN JSON */
      header('Content-type: aplication/json');
      echo json_encode($res);
      break;
    }    

    /** MODIFICA LA ORDEN EN LA DB */
    try {
      $orden->modificarOrden($_POST['id']);
      
      if (isset($_POST['id_campo']) && isset($_POST['tag'])) {
        $id_campo = $_POST['id_campo'];
        $tag = $_POST['tag'];
        $content = $_POST['content'];

        for ($i = 0; $i < sizeof($id_campo); $i++) {
          $orden->editarCampoExtra($id_campo[$i], $tag[$i], $content[$i]);
        }
      }
      $res['error'] = false;

    } catch (PDOException $e) {
      $res['error'] = true;
      $res['msg']   = 'No se pudo registrar la orden';
      $res['code']  = $e->getCode();
    }
    /** DEVUELVE UNA RESPUESTA EN JSON */
    header('Content-type: aplication/json');
    echo json_encode($res);
    break;

  case 'eliminar':
    try {
      if (empty($_POST['id'])) {
        throw new Exception("No se recibió la información");
      }

      $valido = $orden->validaUsuarioEvento($_POST['id_evento']);

      if (!$valido && $_SESSION['usuario']['rol'] != 'Administrador') {
        throw new Exception('No tiene permiso de editar esta orden');
      }

    } catch (Exception $e) {
      $res['error'] = true;
      $res['msg']   = $e->getMessage();
      header('Content-type: aplication/json');
      echo json_encode($res);
      die;
    }    
    
    try {
      $orden->eliminarOrden($_POST['id'], $_POST['id_evento']);
      $res['error'] = false;

    } catch (PDOException $e) {
      $res['error'] = true;
      $res['msg']   = 'No se pudo eliminar la orden';
      $res['log']   = $e->getMessage();
    }
    header('Content-type: aplication/json');
    echo json_encode($res);
    break;

  case 'obtener':
    if (empty($_POST['id'])) { // FIXME: REPARAR LOS ÚLTIMOS CASE
      echo 0;
      die;
    }
    $res = $tabla->obtener_datos_donde('id_orden', $_POST['id']);
    echo json_encode($res);
    break;

  default:
    $res = $tabla->obtener_datos_donde('id_evento', $_POST['id']);

    echo json_encode($res);
    break;
}