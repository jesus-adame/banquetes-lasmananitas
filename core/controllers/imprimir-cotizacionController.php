<?php

/**----------- MODELO COTIZACIÓN --------------*/
include_once 'core/models/CotizacionModel.php';
$c = new Cotizacion;

/**---------- USAMOS LA LIBRERIA DE PDF ----------*/
use Spipu\Html2Pdf\Html2Pdf;

$folio = isset($_GET['folio']) ? $_GET['folio'] : '';

/**----------- FORMATO DE LA HOJA ----------------*/
$pdf = new Html2Pdf('P', '', 'es', 'true', 'UTF-8');

/**---------- VERIFICA LOS DATOS POR GET ------------*/
if (empty($folio) || !isset($_SESSION['usuario'])) {
   echo '<!DOCTYPE html>
   <html lang="es">
   <head>
   <meta charset="UTF-8">
   <title>Cotizacion</title>
   </head><body>No se encontró el arcvivo</body>
   </html>';
   die();
}

/**---------- OBTIENE LOS DATOS DE LA COTIZACION --------*/
$cotizacion = $c->getCotizacion($folio, $_SESSION['usuario']['id_usuario']);
$detalle = $c->getDetalleCotizacion($cotizacion[0]['id']);
$usuario = $c->getUsuario($cotizacion[0]['usuario_id']);

if (count($cotizacion) > 0) {
   $cotizacion = $cotizacion[0];
}

/**-------------- VARIABLES SMARTY -------------*/
$html->assign('folio', $folio);
$html->assign('cotizacion', $cotizacion);
$html->assign('detalle', $detalle);
$html->assign('usuario', isset($usuario['nombre']) ? $usuario['nombre']. ' ' . $usuario['apellidos'] : $usuario['username']);

/**-------------- CARGA LA VISTA EN LA CACHÉ -----------*/
ob_start();
$html->display(TEMP_PDF .'cotizacion.html');
$html = ob_get_clean();

/**-------------- PINTA LA VISTA EN EL DOCUMENTO PDF -----------*/
$pdf->writeHTML($html);
$pdf->output('Cotizacion_'. date('d-m-y ') .'.pdf');
die();

?>