<?php session_start();
require_once '../config/conexion.php';

// Datos que se enviarán de respuesta al frontend
$res = array(
   'msg' => '',
   'error' => false
);

// if ($_SESSION['puesto'] != 'Administrador') {  // Bloquea el permiso a personal no autorizado
//   $res['msg'] = 'No tiene permiso para realizar esa operación';
//   $res['error'] = true;
// } else {

   if ($_POST['action'] === 'borrar') {
   $sql = "DELETE FROM precios_renta WHERE id_precio = :id_precio";

   if (Conexion::query($sql, array('id_precio' => $_POST['id_precio']), false)) {
      $res['msg'] = 'No se pudo eliminar';
      $res['error'] = true;
   }

   } else if (empty($_POST['lugar']) || empty($_POST['tipo_evento'])
   || empty($_POST['precio_alta']) || empty($_POST['precio_baja'])) {

   $res['msg'] = 'Debe llenar todos los campos';
   $res['error'] = true;

   } else {

      $data = array(
         'lugar' => $_POST['lugar'],
         'evento' => $_POST['tipo_evento'],
         'precio_alta' => $_POST['precio_alta'],
         'precio_baja' => $_POST['precio_baja']
      );

      switch ($_POST['action']) {
         case 'insertar':
            $sqlSelect = "SELECT id_precio FROM precios_renta WHERE id_tipo_evento = :e AND id_lugar = :l";

            $validate = Conexion::query($sqlSelect, array('e' => $data['evento'], 'l' => $data['lugar']), true);

            if (sizeof($validate, 0) > 0) {
               $res['msg'] = 'Ese precio ya ha sido registrado';
               $res['error'] = true;

            } else {
               $sql = "INSERT INTO precios_renta (id_tipo_evento, id_lugar, precio_alta, precio_baja)
               VALUES (:evento, :lugar, :precio_alta, :precio_baja)";

               if (Conexion::query($sql, $data, false)) {
                  $res['msg'] = 'datos insertados';
                  $res['error'] = false;
               } else {
                  $res['msg'] = 'Error al insertar';
                  $res['error'] = true;
               }
            }
         break;

         case 'editar':
            $sql = "UPDATE precios_renta (id_tipo_evento, id_lugar, precio_alta, precio_baja)
            VALUES (:evento, :lugar, :precio_alta, :precio_baja)";

            if (Conexion::query($sql, $data, false)) {
               $res['msg'] = 'datos insertados';
               $res['error'] = false;
            } else {
               $res['msg'] = 'Error al editar';
               $res['error'] = true;
            }
         break;
      }
   }
// }

header('Content-type:application/json');
echo json_encode($res);
?>