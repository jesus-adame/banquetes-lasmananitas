<?php

    include_once 'core/models/CotizacionModel.php';
    use Spipu\Html2Pdf\Html2Pdf;

    setlocale(LC_ALL, 'es_MX.utf8');

    class ImprimirCotizacionController {

        public function index($id) {
            Utils::isUser();
            
            /** Motor de plantillas */
            $html = new Smarty();
            $c = new Cotizacion;
            $folio = isset($id) ? $id : '';

            /**----------- FORMATO DE LA HOJA ----------------*/
            $pdf = new Html2Pdf('P', '', 'es', 'true', 'UTF-8');

            $pdf->pdf->SetFont('English111VivaceBT', 'regular', 'english111vivacebt.php');
            $pdf->pdf->SetFont('caslon540btroman_9508', 'regular', 'caslon540btroman_9508.php');
            $pdf->pdf->SetTitle('Cotización');

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

            if (count($cotizacion) < 1) {
            $pdf->writeHTML('<h1>No tienes acceso a esta información</h1>');
            $pdf->output('Cotizacion_'. date('d-m-Y') .'.pdf');
            die();
            }

            $detalle = $c->getDetalleCotizacion($cotizacion[0]['id']);
            $usuario = $c->getUsuario($cotizacion[0]['usuario_id']);

            if (count($cotizacion) > 0) {
            $cotizacion = $cotizacion[0];
            }

            /**-------------- VARIABLES PHP ----------------*/
            $fecha = ucfirst(strftime('%A %d', strtotime($cotizacion['fecha']))). ' de ' .ucfirst(strftime('%B del %Y', strtotime($cotizacion['fecha'])));

            /**-------------- VARIABLES SMARTY -------------*/
            $html->assign('folio', $folio);
            $html->assign('fecha', $fecha);
            $html->assign('cotizacion', $cotizacion);
            $html->assign('detalle', $detalle);
            $html->assign('usuario', isset($usuario['nombre']) ? strtoupper($usuario['nombre']. ' ' . $usuario['apellidos']) : $usuario['username']);

            /**-------------- CARGA LA VISTA EN LA CACHÉ -----------*/
            ob_start();
            $html->display(TEMP_PDF_PATH .'cotizacion.html');
            $html = ob_get_clean();

            /**-------------- PINTA LA VISTA EN EL DOCUMENTO PDF -----------*/
            $pdf->writeHTML($html);
            $pdf->output('Cotizacion_'. date('d-m-Y ') .'.pdf');
            die();
        }
    }