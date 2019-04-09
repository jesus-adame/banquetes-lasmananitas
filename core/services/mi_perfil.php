<?php

if (isset($_POST['action'])) {

   /** MENÚ DEL SERVICIO MI_PERFIL */
   switch ($_POST['action']) {

      /** OBTIENE LOS DATOS DE UN USUARIO */
      case 'obtener_datos':
         $data = array(
            'username' => $_POST['user']
         );

         $sql = 'SELECT * FROM usuarios as u LEFT JOIN detalle_usuario as d
         ON u.id_usuario = d.id_usuario WHERE u.username = :username';

         $res['data']  = Conexion::query($sql, $data, true, true);
         $res['msg']   = 'Obtienes los datos';
         $res['error'] = false;
         break;

      /** ACTUALIZA LOS DATOS DE UN USUARIO */
      case 'actualizar_datos':
         
         $data = array(
            'id_user'   => $_POST['id_user'],
            'name'      => $_POST['name'],
            'last_name' => $_POST['last-name'],
            'email'     => $_POST['email'],
            'tel'       => $_POST['number']
         );

         $is_usuario = validaUsuario($data['id_user']);

         if ($is_usuario) {
            $is_data = comprobarDetalleDatos($data['id_user']);

            if ($is_data) {
               $sql = "UPDATE detalle_usuario SET
               nombre           = :name,
               apellidos        = :last_name,
               correo           = :email,
               telefono         = :tel
               WHERE id_usuario = :id_user";

               $res['data'] = Conexion::query($sql, $data);
               $res['msg']  = 'Se actualizarón los datos';

            } else {
               $sql = "INSERT INTO detalle_usuario
               (id_usuario, nombre, apellidos, correo, telefono)
               VALUES
               (:id_user, :name, :last_name, :email, :tel)";

               $res['data'] = Conexion::query($sql, $data);
               $res['msg']  = 'Se insertaron los datos';
            }
            $res['error'] = false;

         } else {
            $res['msg']   = 'El usuario ingresado no existe';
            $res['error'] = true;
         }
         break;
   }
}

/** COMPRUEBA  */
function comprobarDetalleDatos($username) {
   $data = array(
   'id' => $username
   );

   $sql = 'SELECT * FROM usuarios as u INNER JOIN detalle_usuario as d
      ON u.id_usuario = d.id_usuario WHERE u.id_usuario = :id';

   return Conexion::query($sql, $data, true, true);
}

function validaUsuario($username)
{
   $data = array(
      'id' => $username
   );

   $sql = 'SELECT * FROM usuarios WHERE id_usuario = :id';

   return Conexion::query($sql, $data, true, true);
}

?>