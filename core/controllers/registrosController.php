<?php

include 'core/models/TablasModel.php';
if ($_SESSION['usuario']['rol'] != 'Administrador') {
   header('location:index.php?view=index');
}

$tabla = new Tabla('usuarios');

$usuarios = $tabla->obtener_datos();

$tabla->setName('empleados');
$empleados = $tabla->obtener_datos();

$tabla->setName('usuario_empleado');
$validados = $tabla->obtener_datos_join('empleados', 'id_empleado');

$html->assign('usuarios', $usuarios);
$html->assign('empleados', $empleados);
$html->assign('validados', $validados);
 