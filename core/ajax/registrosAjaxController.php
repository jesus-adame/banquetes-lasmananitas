<?php header('Content-type: application/json');
require '../config/conexion.php';
require '../models/UsuariosModel.php';
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

                    $res = $usu->insertarUsuario();

                    if ($res) {
                        echo json_encode('success');
                    } else {
                        echo json_encode('error');
                    }
                }
            } else {
                echo json_encode('pass_dont_match');
            }
            
        } else {
            echo json_encode('empty_fields');
        }
    break;

    case 'editar':
        if (!empty($_POST['id']) || !empty($_POST['pass']) || !empty($_POST['pass2'])) {
            
            if ($_POST['pass'] === $_POST['pass2']) {
                $usu->setName($_POST['usuario']);
                $pass = sha1($_POST['pass']);
                $usu->setPass($usu);
                
                $res = $usu->editarUsuario($_POST['id']);

                if ($res) {
                    echo json_encode('success');
                } else {
                    echo json_encode('error');
                }
            } else {
                echo json_encode('pass_dont_match');
            }
            
        } else {
            echo json_encode('empty_fields');
        }
    break;

    case 'borrar':
        if (!empty($_POST['id'])) {

            $res = $usu->borrarUsuario($_POST['id']);

            if ($res) {
                echo json_encode('success');
            } else {
                echo json_encode('error');
            }
        } else {
            echo json_encode('empty_fields');
        }
    break;

    default:
        echo 'No se detectó su solicitud';
    break;
}




