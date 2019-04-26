<?php

session_start();
require '../config/conexion.php';
require '../models/UsuariosModel.php';
require '../models/TablasModel.php';
$usu = new Usuario();

$res = array(
    'error' => true
);

switch ($_POST['action']) {
    case 'agregar':
        /** VALIDA LOS DATOS POR POST */
        if (empty($_POST['usuario']) || empty($_POST['pass']) || empty($_POST['pass2'])) {
            $res['msg']   = 'Debes llenar todos los campos';
            $res['error'] = true;
        }

        /** VALIDA LAS CONTRASEÑAS */
        if ($_POST['pass'] != $_POST['pass2']) {
            $res['msg']   = 'Las contraseñas no coinciden';
            $res['error'] = true;
            break;

        } else if (strlen($_POST['pass']) < 6) {
            $res['msg']   = 'Las contraseñas deben contener al menos 6 caracteres';
            $res['error'] = true;
            break;
        }

        /** SETEA EL USUARIO */
        $usu->setName($_POST['usuario']);
        $pass = sha1($_POST['pass']);
        $usu->setPass($pass);

        $t = new Tabla('usuarios');

        /** VALIDA QUE NO EXISTA OTRO USUARIO CO EN MISMO NOMBRE */
        $is_user = $t->obtener_datos_donde('username', $_POST['usuario']);

        if (!$is_user) {
            /** INSERTA EL USUARIO */
            $usu->insertarUsuario($_POST['nivel'], $_POST['estado']);
            $res['error'] = false;

        } else {
            $res['msg']   = 'Ya existe un registro con ese nombre de usuario';
            $res['error'] = true;
        }
        break;

    case 'editar':
        $usu->setName($_POST['usuario']);
        /** EDITA EL USUARIO */
        $edit = $usu->editarUsuario($_POST['id'], $_POST['nivel'], $_POST['estado']);

        /** VALIDA QUE NO HAYAN ERRORES */
        if (!$edit) {
            $res['error'] = true;
            $res['msg']   = 'No se pudo editar';
            break;
        }
        $res['error'] = false;
        break;

    case 'borrar':
        if (empty($_POST['id'])) {
            $res['error'] = true;
            $res['msg']   = 'Debes llenar todos los campos';
            break;
        }

        // BORRAR EL USUARIO
        $delete = $usu->borrarUsuario($_POST['id']);

        // VARIFICA SI HAY ERRORES
        if (!$delete) {
            $res['msg']   = 'No se pudo borrar';
            $res['error'] = true;
            break;
        }
        $res['error'] = false;
        break;

    case 'cambiar_pass':
        // VALIDA LOS DATOS POR POST
        if (empty($_POST['pass']) || empty($_POST['pass1']) || empty($_POST['pass2'])) {
            $res['msg']   = 'Debes llenar todos los campos';
            $res['error'] = true;
            break;
        }

        // VALIDA LA CONTRASEÑA
        if ($_POST['pass1'] != $_POST['pass2']) {
            $res['msg']   = 'Las contraseñas no coinciden';
            $res['error'] = true;
            break;

        } else if (strlen($_POST['pass1']) < 6) {
            $res['msg']   = 'Las contraseñas deben contener al menos 6 caracteres';  
            $res['error'] = true;
            break;                  
        }

        // CIFRA LAS CONTRASEÑAS
        $pass  = sha1($_POST['pass']);
        $pass1 = sha1($_POST['pass1']);
        
        // VALIDA LA AUTENTICIDAD DEL USUARIO
        $validar = $usu->validar($_SESSION['usuario']['id_usuario'], $pass);
        
        if ($validar) {
            // CAMBIA LA CONTRASEÑA
            $usu->cambiarPass($_SESSION['usuario']['id_usuario'], $pass1);
            $res['error'] = false;

        } else {
            $res['msg']   = $_SESSION['error']['msg'];
            $res['error'] = true;
            unset($_SESSION['error']);
        }
        break;

    case 'auto_agregar':
        // VALIDA EL FORMULARIO
        if (empty($_POST['usuario']) || empty($_POST['pass']) || empty($_POST['pass2'])) {
            $res['msg']   = 'Debes llenar todos los campos';
            $res['error'] = true;
            break;
        }

        // VALIDA LA CONTRASEÑA
        if ($_POST['pass'] != $_POST['pass2']) {
            $res['msg']   = 'Las contraseñas no coinciden';
            $res['error'] = true;
            break;

        } else if (strlen($_POST['pass']) < 6) {
            $res['msg']   = 'Las contraseñas deben contener al menos 6 caracteres';  
            $res['error'] = true;
            break;                  
        }

        // SETEA EL USUARIO
        $usu->setName($_POST['usuario']);
        $pass = sha1($_POST['pass']);
        $usu->setPass($pass);
        $nivel = 'Consulta';

        $t = new Tabla('usuarios');
        $is_user = $t->obtener_datos_donde('username', $_POST['usuario']);
        
        // VALIDA SI NO EXISTE ESE USUARIO EN LA DB
        if (count($is_user) < 1) {
            // INSERTA EL USUARIO
            $usu->insertarUsuario($nivel, 0);
            $res['error'] = false;

        } else {
            $res['msg']   = 'Ya existe un registro con ese nombre de usuario';
            $res['error'] = true;
        }
        break;

    default:
        $res['msg']   = 'No se detectó su solicitud';
        $res['error'] = true;
        break;
}
// DEVUELVE EL RESULTADO EN JSON
header('Content-type: application/json');
echo json_encode($res);

?>
