<?php
$html = new Smarty();

$html->assign('titulo', '');
$html->assign('subtitulo', 'Calendario');
$html->display('views/supervisor.html');
?>
