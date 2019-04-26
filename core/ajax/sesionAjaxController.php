<?php

session_start();
include_once '../models/SesionModel.php';
require_once '../config/conexion.php';

$res = array(
  'error' => true
);

switch ($_POST['accion']) {
  case 'iniciar':
    if (empty($_POST['usuario']) || empty($_POST['pass'])) {
      $res['error'] = true;
      $res['msg']   = 'Debes llenar todos los campos';
      break;
    }

    $user = $_POST['usuario'];
    $pass = sha1($_POST['pass']);

    $sesion = new Sesion($user, $pass);

    try {
      $success = $sesion->iniciarSesion();

      if (!$success) {
        throw new PDOException('Datos de usuario incorrectos', 1000);
      }

      $res['error'] = false;

    } catch (\PDOException $e) {
      if ($e->getCode() === 1000) {
        $res['msg'] = $e->getMessage();
      } else {
        $res['msg'] = 'Ocurrió un error interno';
        $res['log'] = $e->getMessage();
      }
      $res['error'] = true;
    }
    break;

  default:
    session_destroy();
    $res['error'] = false;
    break;
}

header('Content-type: aplication/json');
echo json_encode($res);
?>
