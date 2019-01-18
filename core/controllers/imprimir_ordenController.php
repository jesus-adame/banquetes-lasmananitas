<?php session_start();
if (!isset($_SESSION['puesto'])) {
    unset($_GET['view']);
    header('location:index.php?view=index');
}

require 'core/lib/vendor/autoload.php';
include 'core/models/TablasModel.php';
use Spipu\Html2Pdf\Html2Pdf;

$html = new Smarty();
$html2pdf = new Html2Pdf('L', '', 'es', 'true', 'UTF-8');
$orden = new Tabla('ordenes_servicio');

$data = $orden->obtener_datos_join('eventos', 'id_evento', 'id_orden', $_GET['id']);
$id_evento = $data[0]['id_evento'];
$fecha_hora = explode(' ', $data[0]['fecha']);
$formato = $data[0]['tipo_formato'];
$campos_dinamicos = $orden->obtener_datos_left_join('campos_ordenes', 'id_orden', 'id_orden', $_GET['id']);

$orden->setName('sub_evento');
$actividades = $orden->obtener_datos_donde('id_evento', $id_evento);

setlocale(LC_ALL, 'es_MX.utf8');
$fecha = strftime('%A %d %B %Y', strtotime($fecha_hora[0]));
$hora = date('h:ia', strtotime($fecha_hora[1]));

$html->assign('fecha', mb_strtoupper($fecha, 'UTF-8'));
$html->assign('hora', strtoupper($hora));
$html->assign('data', $data[0]);
$html->assign('act', $actividades);
$html->assign('d_data', $campos_dinamicos);

switch ($formato) {
    case 'grupo':
        $template = 'views/templates/pdf/orden_servicio_grupo.html';
    break;

    case 'coctel':
        $template = 'views/templates/pdf/orden_servicio_coctel.html';
    break;

    case 'ceremonia':
        $template = 'views/templates/pdf/orden_servicio_ceremonia.html';
    break;

    case 'banquete':
        $template = 'views/templates/pdf/orden_servicio_banquete.html';
    break;
}

ob_start();
$html->display($template);
$html = ob_get_clean();

$html2pdf->writeHTML($html);
$html2pdf->output('Orden_de_servicio_'.date('d-m-y').'.pdf');
