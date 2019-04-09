<?php

if ($_SESSION['usuario']['rol'] != 'Administrador') {
   header('location:index.php?view=index');
}

include 'core/models/TablasModel.php';
$tabla = new Tabla('usuarios');

$usuarios = $tabla->obtener_datos();
$html->assign('usuarios', $usuarios);
 