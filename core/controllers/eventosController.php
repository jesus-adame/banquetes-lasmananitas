<?php
if ($_SESSION['puesto'] != 'Ventas' && $_SESSION['puesto'] != 'Supervisor' && $_SESSION['puesto'] != 'Administrador') {
    header('location:index.php?view=index');
}
$html = new Smarty();

$html->assign('titulo', 'Eventos');
$html->assign('subtitulo', 'Panel de gestión');
$html->display('views/eventos.html');
?>
