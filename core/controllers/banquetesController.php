<?php
$html = new Smarty();

$html->assign('titulo', 'Banquetes');
$html->assign('subtitulo', 'Platillos las Mañanitas');
$html->display('views/banquetes.html');
?>
