<?php header('Content-type: application/json');
session_start();
require '../config/conexion.php';
require '../models/UsuariosModel.php';
require '../models/TablasModel.php';
$usu = new Usuario();

switch ($_POST['action']) {
    case 'agregar':
        if (!empty($_POST['usuario']) && !empty($_POST['pass']) && !empty($_POST['pass2'])) {

            if ($_POST['pass'] === $_POST['pass2']) {

                if (strlen($_POST['pass']) < 6) {
                    echo json_encode('dont_length');
                } else {
                    $usu->setName($_POST['usuario']);
                    $pass = sha1($_POST['pass']);
                    $usu->setPass($pass);

                    $res = $usu->insertarUsuario($_POST['nivel']);

                    if ($res) {
                        echo json_encode('success');
                    } else {
                        echo json_encode('error');
                    }
                }
            } else { echo json_encode('pass_dont_match'); }
            
        } else { echo json_encode('empty_fields'); }
    break;

    case 'editar':
            
        $usu->setName($_POST['usuario']);
        
        $res = $usu->editarUsuario($_POST['id'], $_POST['nivel'], $_POST['estado']);

        if ($res) {
            echo json_encode('success');
        } else { echo json_encode('error'); }
    break;

    case 'borrar':
        if (!empty($_POST['id'])) {

            $res = $usu->borrarUsuario($_POST['id']);

            if ($res) {
                echo json_encode('success');
            } else {
                echo json_encode('error');
            }
        } else { echo json_encode('empty_fields'); }
    break;

    case 'cambiar_pass':
        if (!empty($_POST['pass']) && !empty($_POST['pass1']) && !empty($_POST['pass2'])) {
            
            if ($_POST['pass1'] === $_POST['pass2']) {
                $pass = sha1($_POST['pass']);
                $pass1 = sha1($_POST['pass1']);
                
                $validar = $usu->validar($_SESSION['id_usuario'], $pass);
                
                if ($validar) {
                    $usu->cambiarPass($_SESSION['id_usuario'], $pass1);
                    echo json_encode('success');
                } else {
                    echo json_encode('error');
                }

            } else { echo json_encode('pass_dont_match'); }
        } else { echo json_encode('empty_fields'); }
    break;

    case 'auto_agregar':
    if (!empty($_POST['usuario']) && !empty($_POST['pass']) && !empty($_POST['pass2'])) {

        if ($_POST['pass'] === $_POST['pass2']) {

            if (strlen($_POST['pass']) < 6) {
                echo json_encode('dont_length');
            } else {
                $usu->setName($_POST['usuario']);
                $pass = sha1($_POST['pass']);
                $usu->setPass($pass);
                $nivel = 'Consulta';

                $t = new Tabla('usuarios');
                $validar = $t->obtener_datos_donde('username', $_POST['usuario']);
                
                if (!$validar) {
                    $res = $usu->insertarUsuario($nivel);
                    echo json_encode('success');
                } else {
                    echo json_encode('error');
                }
            }
        } else { echo json_encode('pass_dont_match'); }
        
    } else { echo json_encode('empty_fields'); }
    break;

    default:
        echo 'No se detectó su solicitud';
    break;
}
