<?php session_start();
include_once '../models/SesionModel.php';
require_once '../config/conexion.php';

// TODO: ACTUALIZAR EL MANEJO DE RESPUESTAS
switch ($_POST['accion']) {
  case 'iniciar':
    if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {
      $user = $_POST['usuario'];
      $pass = sha1($_POST['pass']);

      $sesion = new Sesion($user, $pass);

      $res = $sesion->iniciarSesion();
      if ($res) {
        echo 'success';
      } else {
        echo 'no_users';
      }
    } else {
      echo 'empty_fields';
    }
    break;

  default:
    session_destroy();
    echo 'logout';
    break;
}
