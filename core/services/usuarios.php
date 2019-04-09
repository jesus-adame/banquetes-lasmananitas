<?php

if (isset($_POST['action'])) {

   /** MENÚ DEL SERVICIO MI_PERFIL */
   switch ($_POST['action']) {

         /** OBTIENE LOS DATOS DE UN USUARIO */
      case 'obtener_usuarios':

         $sql = 'SELECT * FROM usuarios as u LEFT JOIN detalle_usuario as d
         ON u.id_usuario = d.id_usuario';

         $res['usuarios'] = Conexion::query($sql, $data, true, true);

         if (!empty($res['usuarios'])) {
            $res['error'] = false;

         } else {
            $res['error'] = true;
            $res['msg']   = 'No hay usuarios registrados';
         }
         break;

         /** ACTUALIZA LOS DATOS DE UN USUARIO */
      case 'obtener_uno':

         $data = array(
            'id' => $_POST['usuario_id']
         );

         $sql = 'SELECT * FROM usuarios as u LEFT JOIN detalle_usuario as d
         ON u.id_usuario = d.id_usuario WHERE u.id_usuario = :id';

         $select = Conexion::query($sql, $data, true);

         if (count($select) > 0) {
            $res['usuario'] = $select[0];
            $res['error']   = false;

         } else {
            $res['error'] = true;
            $res['msg']   = 'No se encontró el usuario especificado';
         }         
         break;
   }
}
 