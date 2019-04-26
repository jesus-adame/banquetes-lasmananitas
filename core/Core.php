<?php

if (!isset($_SESSION)) {
   session_start();
}

/** SE REQUIERE LA CONEXION A LA BASE DE DATOS Y MANEJO RÁPIDO DE QUERYS */
require_once 'config/conexion.php';
require_once 'helpers/Utils.php';

$service = isset($_POST['module']) ? $_POST['module'] : '';

/** RESPUESTA EN FORMA DE ARRAY */
$res = array(
   'error' => true
);

/** SE INCLUYE EL MÓDULO SOLICITADO */
if ($service != '') {
   $serv_path = 'services/'. $service .'.php';

   if (is_file($serv_path)) {
      /** SI EXISTE EL MÓDULO SOLICITADO, SE INCLUYE */
      include_once $serv_path;

   } else {
      /** SI NO EXISTE EL MÓDULO SOLICITADO */
      $res['msg'] = 'El módulo solicidato no existe';
   }

}

/** RESPUESTA EN FORMATO JSON */
header('Content-type: aplication/json');
echo json_encode($res);

?>