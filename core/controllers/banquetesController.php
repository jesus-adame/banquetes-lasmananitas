<?php
if (!isset($_SESSION['puesto'])) {
    unset($_GET['view']);
    header('location:index.php?view=index');
}
$html = new Smarty();

$html->assign('titulo', 'Banquetes');
$html->assign('subtitulo', 'Platillos las Mañanitas');
$html->display('views/banquetes.html');
?>
