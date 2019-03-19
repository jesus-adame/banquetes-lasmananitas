<?php

include 'models/CotizacionModel.php';

if (isset($_POST['action'])) {
   $c = new Cotizacion();

   /** MENÚ DEL SERVICIO EVENTOS */
   switch ($_POST['action']) {
      /** INSERT */
      case 'insert_event':
         $res['msg'] = 'Insertar Evento';

         $cliente = $c->insertCliente();

         if (is_array($cliente)) { $cliente_id = (int) $cliente['id']; } else { $cliente_id = $cliente; }
         
         if ($cliente_id) {
            if (isset($_SESSION['usuario']['nombre']) && isset($_SESSION['usuario']['apellido'])) {
               $responsable = $_SESSION['usuario']['nombre']. ' ' .$_SESSION['usuario']['apellido'];

            } else {
               $responsable = $_SESSION['usuario']['username'];
            }

            $data_evento = array(
               'title' => $_POST['title'],
               'evento' => $_POST['evento'],
               'contacto' => $_POST['nombre']. ' ' .$_POST['apellido'],
               'cord_resp' => strtoupper($responsable),
               'start' => $_POST['start'],
               'end' => $_POST['end'],
               'id_lugar' => $_POST['id_lugar'],
               'personas' => $_POST['personas'],
               'categoria' => $_POST['categoria'],
               'color' => '#d7c735',
               'id_usuario' => $_SESSION['usuario']['id_usuario']
            );

            $evento_id = (int) $c->insertEvento($data_evento);
            $c->insertCotizacion($evento_id, $cliente_id);    
            $res['data'] = array('evento_id' => $evento_id);
            $res['error'] = false;

         } else {
            $res['msg'] = 'Error al validar el cliente';
            $res['error'] = true;
         }
         break;
      
      /** SELECT */
      case 'obtener_cotizaciones':
         $cotizaciones = $c->getAll($_POST['evento_id']);

         if (count($cotizaciones) > 0) {
            $res['msg'] = 'Correcto';
            $res['data'] = $cotizaciones;
            $res['error'] = false;

         } else {
            $res['msg'] = 'No hay cotizaciones';
            $res['error'] = true;
         }
         break;

      /** SELECT */
      case 'obtener_totales':
         $totales = $c->getTotalCotizacion($_POST['cot']);

         if ($totales != null) {
            $res['data'] = $totales;
            $res['error'] = false;
            $res['msg'] = 'Totales de la cotizacion folio: '. $_POST['cot'];
         } else {
            $res['msg'] = 'No se encontraron datos';
            $res['error'] = true;
         }
         break;
   }
} else {
   $res['msg'] = 'No se reconoció el comando';
   $res['error'] = true;
}

?>