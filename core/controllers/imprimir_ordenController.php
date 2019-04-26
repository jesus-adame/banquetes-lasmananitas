<?php

    use Spipu\Html2Pdf\Html2Pdf;

    /** FORMATO DE FECHAS Y NÚMEROS DE MÉXICO */
    setlocale(LC_ALL, 'es_MX.utf8');

    class OrdenPdfController {
        public function index($id) {
            include './core/models/OrdenModel.php';

            Utils::isUser();

            /**--------- OBJETOS --------*/
            $html     = new Smarty();
            $html2pdf = new Html2Pdf('L', '', 'es', 'true', 'UTF-8');
            $orden    = new Orden();
            $html2pdf->pdf->SetTitle('Orden de servicio');

            /**----------- VARIABLES -------------*/
            $data_orden       = $orden->getOne($id);
            $id_evento        = $data_orden['id_evento'];
            $fecha_hora       = explode(' ', $data_orden['fecha']);
            $formato          = $data_orden['tipo_formato'];
            $campos_dinamicos = $orden->getExtraInputs($id);

            // Obtener logística
            $sql = "SELECT * FROM sub_evento WHERE id_evento = :id_evento";
            $actividades = Conexion::query($sql, ['id_evento' => $id_evento], true);

            /**------------- FECHAS DE LA ORDEN ------------*/
            $fecha = strftime('%A %d %B %Y', strtotime($fecha_hora[0]));
            $hora = date('h:ia', strtotime($fecha_hora[1]));

            /**------------- VARIABLES SMARTY ---------------*/
            $html->assign('fecha', mb_strtoupper($fecha, 'UTF-8'));
            $html->assign('hora', strtoupper($hora));
            $html->assign('data', $data_orden);
            $html->assign('act', $actividades);
            $html->assign('d_data', $campos_dinamicos);

            /**-------------- MENU DE ORDENES ----------------*/
            switch ($formato) {
                case 'grupo':
                    $template = 'orden_servicio_grupo.html';
                    break;

                case 'coctel':
                    $template = 'orden_servicio_coctel.html';
                    break;

                case 'ceremonia':
                    $template = 'orden_servicio_ceremonia.html';
                    break;

                case 'banquete':
                    $template = 'orden_servicio_banquete.html';
                    break;
            }

            /**-------------- MUESTRA LA PLANTILLA HTML --------------*/
            ob_start();
            $html->display(TEMP_PDF_PATH . $template);
            $html = ob_get_clean();

            /**-------------- ESCRIBE Y MUESTRA EL PDF ---------------*/
            $html2pdf->writeHTML($html);
            $html2pdf->output('Orden_de_servicio_' . date('d-m-Y') . '_' . $data_orden['title'] . '.pdf');
        }
    }