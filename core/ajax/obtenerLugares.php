<?php header('Content-type: application/json');
require '../config/conexion.php';
include '../models/TablasModel.php';
$lugares = new Tabla('lugares');

$res = array(
   'msg' => '',
   'error' => false
);

// TODO: ACTUALIZAR EL MANEJO DEL MÓDULO
if (isset($_POST['action']) && !empty( $_POST['action']) && $_POST['action'] !== 'obtener') {

   if ($_POST['action'] === 'agregar') {

      $sql = 'INSERT INTO lugares (lugar) VALUES (:lugar)';
      $query = Conexion::query($sql, array('lugar' => $_POST['lugar']));

      if ($query) {
         $res['msg'] = 'Se agregó el registro';
      } else {
         $res['msg'] = 'No se pudo agregar';
         $res['error'] = true;
      }

   } else if ($_POST['action'] === 'eliminar') {
      $sql = 'DELETE FROM lugares WHERE id_lugar = :id_lugar';
      $query = Conexion::query($sql, array('id_lugar' => $_POST['id_lugar']));

      if ($query) {
         $res['msg'] = 'Se eliminó el registro';
      } else {
         $res['msg'] = 'No se pudo eliminar';
         $res['error'] = true;
      }
   }
   

} else {
   $res = $lugares->obtener_datos();
}

if ($res) {
echo json_encode($res);
} else { echo json_encode('fail'); }