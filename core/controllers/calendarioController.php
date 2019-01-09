<?php
if (!isset($_SESSION['puesto'])) {
    unset($_GET['view']);
    header('location:index.php?view=index');
}
$html = new Smarty();

$html->assign('titulo', 'Calendario');
$html->assign('subtitulo', 'Registro de Actividades');
$html->display('./views/calendario.html');
?>
