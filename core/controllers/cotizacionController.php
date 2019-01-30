<?php
$html = new Smarty();

$html->assign('titulo', 'Cotización');
$html->display('views/cotizacion.html');