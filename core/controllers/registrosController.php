<?php
include 'core/models/TablasModel.php';
if ($_SESSION['puesto'] != 'Administrador') {
   header('location:index.php?view=index');
}
$html = new Smarty();
$tabla = new Tabla('usuarios');

$usuarios = $tabla->obtener_datos();

$tabla->setName('empleados');
$empleados = $tabla->obtener_datos();

$tabla->setName('usuario_empleado');
$validados = $tabla->obtener_datos_join('empleados', 'id_empleado');


$html->assign('titulo', 'Personal');
$html->assign('subtitulo', 'Control de Usuarios');
$html->assign('usuarios', $usuarios);
$html->assign('empleados', $empleados);
$html->assign('validados', $validados);
$html->display('views/registros.html');
 