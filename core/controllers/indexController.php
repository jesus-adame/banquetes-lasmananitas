<?php
$html = new Smarty();

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'N/A';
$puesto = isset($_SESSION['puesto']) ? $_SESSION['puesto'] : 'N/A';
$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : '';

$html->assign('titulo', 'Inicio');
$html->assign('id_usuario', $id_usuario);
$html->assign('usuario', $usuario);
$html->assign('puesto', $puesto);
$html->assign('subtitulo', 'Sistema de Banquetes Casa Nueva');
$html->display('views/index.html');
?>
