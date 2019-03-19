<?php

/**-------- COMPRUEBA LA SESIÓN ----------*/
if (!isset($_SESSION['usuario'])) {
    unset($_GET['view']);
    header('location:index.php?view=index');
}

include 'core/models/TablasModel.php';
use Spipu\Html2Pdf\Html2Pdf;

/**----- FORMATO DE FECHAS Y NÚMEROS DE MÉXICO -----*/
setlocale(LC_ALL, 'es_MX.utf8');

/**--------- OBJETOS --------*/
$html2pdf = new Html2Pdf('L', '', 'es', 'true', 'UTF-8');
$orden = new Tabla('ordenes_servicio');

/**----------- VARIABLES -------------*/
$temp_path = 'public/views/templates/pdf/';
$id_evento = $data[0]['id_evento'];
$data = $orden->obtener_datos_join('eventos', 'id_evento', 'id_orden', $_GET['id']);
$fecha_hora = explode(' ', $data[0]['fecha']);
$formato = $data[0]['tipo_formato'];
$campos_dinamicos = $orden->obtener_datos_left_join('campos_ordenes', 'id_orden', 'id_orden', $_GET['id']);
$orden->setName('sub_evento');
$actividades = $orden->obtener_datos_donde('id_evento', $id_evento);

/**------------- FECHAS DE LA ORDEN ------------*/
$fecha = strftime('%A %d %B %Y', strtotime($fecha_hora[0]));
$hora = date('h:ia', strtotime($fecha_hora[1]));

/**------------- VARIABLES SMARTY ---------------*/
$html->assign('fecha', mb_strtoupper($fecha, 'UTF-8'));
$html->assign('hora', strtoupper($hora));
$html->assign('data', $data[0]);
$html->assign('act', $actividades);
$html->assign('d_data', $campos_dinamicos);

/**-------------- MENU DE ORDENES ----------------*/
switch ($formato) {
    case 'grupo':
        $template = $temp_path. 'orden_servicio_grupo.html';
        break;

    case 'coctel':
        $template = $temp_path. 'orden_servicio_coctel.html';
        break;

    case 'ceremonia':
        $template = $temp_path. 'orden_servicio_ceremonia.html';
        break;

    case 'banquete':
        $template = $temp_path. 'orden_servicio_banquete.html';
        break;
}

/**-------------- MUESTRA LA PLANTILLA HTML --------------*/
ob_start();
$html->display($template);
$html = ob_get_clean();

/**-------------- ESCRIBE Y MUESTRA EL PDF ---------------*/
$html2pdf->writeHTML($html);
$html2pdf->output('Orden_de_servicio_' . date('d-m-y') . '.pdf');
die();

?>