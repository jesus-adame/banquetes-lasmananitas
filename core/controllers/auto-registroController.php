<?php
/**
 * Página de autoregistro
 */
$html = new Smarty();

$html->assign('titulo', 'Registrarse');
$html->assign('subtitulo', 'Calendario');
$html->display('views/auto-registro.html');
?>
