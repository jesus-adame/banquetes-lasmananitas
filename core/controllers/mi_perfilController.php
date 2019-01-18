<?php
if (!isset($_SESSION['puesto'])) {
    unset($_GET['view']);
    header('location:index.php?view=index');
}
$html = new Smarty();

$html->assign('titulo', 'Mi perfil');
$html->assign('usuario', $_SESSION['usuario']);
$html->display('views/mi_perfil.html');