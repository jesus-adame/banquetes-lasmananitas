<?php session_start();
header('Content-type: application/json');
include '../models/TablasModel.php';
include '../models/OrdenModel.php';
require_once '../config/conexion.php';
$tabla = new Tabla('ordenes_servicio');
$orden = new Orden();

$accion = isset($_POST['accion']) ? $_POST['accion'] : 'leer';

switch ($accion) {
  case 'agregar':
    if (!empty($_POST['id_evento']) && !empty($_POST['nombre'])
    && !empty($_POST['lugar']) && !empty($_POST['montaje'])
    && !empty($_POST['garantia'])) {

      
      $datos = crearArrayDatos($_POST['tipo_formato']);
      
      $lastInsertId = $orden->agregarOrden($datos);
      
      if (isset($_POST['tag']) && isset($_POST['content'])) {
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
      
      $datos = crearArrayDatos($_POST['tipo_formato']);
      
      $res = $orden->modificarOrden($_POST['id'], $datos);
      
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

/**
 * Creardor de array de datos enviados por POST
 */

function crearArrayDatos($formato)
{
  switch ($formato) {
    case 'banquete':
      $datos = array(
        $_POST['id_evento'],
        $_POST['fecha']. ' ' .$_POST['time'],
        $_POST['nombre'],
        $_POST['lugar'],
        $_POST['montaje'],
        '',
        $_POST['entrada'],
        $_POST['fuerte'],
        $_POST['postre'],
        $_POST['bebidas'],
        '',
        $_POST['mezcladores'],
        $_POST['detalle_montaje'],
        $_POST['ama_llaves'],
        $_POST['mantenimiento'],
        $_POST['seguridad'],
        $_POST['recursos_humanos'],
        $_POST['proveedores'],
        $_POST['contabilidad'],
        $_POST['garantia'],
        $_POST['chief_steward'],
        $_POST['observaciones'],
        $_POST['tipo_formato']
      );
    break;

    case 'grupo':
      $datos = array(
        $_POST['id_evento'],
        $_POST['fecha']. ' ' .$_POST['time'],
        $_POST['nombre'],
        $_POST['lugar'],
        $_POST['montaje'],
        $_POST['canapes'],
        '',
        '',
        '',
        '',
        '',
        '',
        $_POST['detalle_montaje'],
        $_POST['ama_llaves'],
        $_POST['mantenimiento'],
        '',
        '',
        '',
        $_POST['contabilidad'],
        $_POST['garantia'],
        $_POST['chief_steward'],
        $_POST['observaciones'],
        $_POST['tipo_formato']
      );
    break;

    case 'ceremonia':
      $datos = array(
        $_POST['id_evento'],
        $_POST['fecha']. ' ' .$_POST['time'],
        $_POST['nombre'],
        $_POST['lugar'],
        $_POST['montaje'],
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $_POST['detalle_montaje'],
        $_POST['ama_llaves'],
        $_POST['mantenimiento'],
        $_POST['seguridad'],
        $_POST['recursos_humanos'],
        $_POST['proveedores'],
        '',
        $_POST['garantia'],
        '',
        $_POST['observaciones'],
        $_POST['tipo_formato']
      );
    break;

    case 'coctel':
      $datos = array(
        $_POST['id_evento'],
        $_POST['fecha']. ' ' .$_POST['time'],
        $_POST['nombre'],
        $_POST['lugar'],
        $_POST['montaje'],
        $_POST['canapes'],
        '',
        '',
        '',
        $_POST['bebidas'],
        $_POST['cocteleria'],
        $_POST['mezcladores'],
        $_POST['detalle_montaje'],
        $_POST['ama_llaves'],
        $_POST['mantenimiento'],
        $_POST['seguridad'],
        $_POST['recursos_humanos'],
        $_POST['proveedores'],
        $_POST['contabilidad'],
        $_POST['garantia'],
        $_POST['chief_steward'],
        '',
        $_POST['tipo_formato']
      );
    break;

    case 'torna':
      $datos = array(
        $_POST['id_evento'],
        $_POST['fecha']. ' ' .$_POST['time'],
        $_POST['nombre'],
        $_POST['lugar'],
        $_POST['montaje'],
        '',
        '',
        $_POST['fuerte'],
        '',
        '',
        '',
        '',
        $_POST['detalle_montaje'],
        $_POST['ama_llaves'],
        $_POST['mantenimiento'],
        $_POST['seguridad'],
        $_POST['recursos_humanos'],
        $_POST['proveedores'],
        $_POST['contabilidad'],
        $_POST['garantia'],
        $_POST['chief_steward'],
        '',
        $_POST['tipo_formato']
      );
    break;
  }

  return $datos;
}