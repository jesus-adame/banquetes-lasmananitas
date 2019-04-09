<?php
include 'models/CotizacionModel.php';

if (isset($_POST['action'])) {
   $c = new Cotizacion();

   /** MENÚ DEL SERVICIO EVENTOS */
   switch ($_POST['action']) {
      /** INSERT */
      case 'insert_event':
         $res['msg'] = 'Insertar Evento';

         $cliente_id = $c->insertCliente();

         if (empty($cliente_id)) {
            $res['msg']   = 'No se pudo registrar el cliente';
            $res['error'] = true;
            break;
         }
         
         if ($cliente_id) {
            if (isset($_SESSION['usuario']['nombre']) && isset($_SESSION['usuario']['apellido'])) {
               $responsable = $_SESSION['usuario']['nombre']. ' ' .$_SESSION['usuario']['apellido'];

            } else {
               $responsable = $_SESSION['usuario']['username'];
            }

            $data_evento = array(
               'title'      => $_POST['title'],
               'evento'     => $_POST['evento'],
               'contacto'   => $_POST['nombre']. ' ' .$_POST['apellido'],
               'cord_resp'  => strtoupper($responsable),
               'start'      => $_POST['start'],
               'end'        => $_POST['end'],
               'id_lugar'   => (int) $_POST['id_lugar'],
               'personas'   => (int) $_POST['personas'],
               'categoria'  => $_POST['categoria'],
               'color'      => '#d7c735',
               'id_usuario' => (int) $_SESSION['usuario']['id_usuario']
            );

            $evento_id     = (int) $c->insertEvento($data_evento);
            $cotizacion_id = $c->insertCotizacion($evento_id, $cliente_id);

            if ($cotizacion_id) {
               $res['data']  = array('evento_id' => $evento_id);
               $res['error'] = false;

            } else {
               $res['error'] = true;
               $res['msg']   = 'No se registró la cotización';
            }

         } else {
            $res['msg']   = 'Error al validar el cliente';
            $res['error'] = true;
         }
         break;
      
      /** SELECT */
      case 'obtener_cotizaciones':
         $cotizaciones = $c->getAll($_POST['evento_id']);

         if (count($cotizaciones) > 0) {
            $res['data']  = $cotizaciones;
            $res['error'] = false;

         } else {
            $res['msg']   = 'No hay cotizaciones';
            $res['error'] = true;
         }
         break;

      /** SELECT */
      case 'obtener_totales':
         $totales = $c->getTotalCotizacion($_POST['cot']);

         if ($totales != null) {
            $res['data']  = $totales;
            $res['error'] = false;
            
         } else {
            $res['msg']   = 'No se encontraron datos';
            $res['error'] = true;
         }
         break;

      case 'insertar_cotizacion':
         $evento_id  = $_POST['evento_id'];
         $cliente_id = $_POST['cliente_id'];

         $insert = $c->insertCotizacion($evento_id, $cliente_id);

         if ($insert) {
            $res['error'] = false;
         } else {
            $res['error'] = true;
            $res['msg']   = 'No se pudo insertar la cotizacion';
         }
         break;

      case 'actualizar_estado':
         $update = $c->cambiarStatus($_POST['folio'], $_POST['status']);

         if ($update) {
            $res['error'] = false;
            
         } else {
            $res['error'] = true;
            $res['msg']   = $_SESSION['error']['msg'];
            unset($_SESSION['error']);
         }
         break;

      case 'enviar_email':
         $data = array(
            'asunto' => $_POST['asunto'],
            'cuerpo' => $_POST['mensaje']
         );
         
         // PERSONAL QUE ENVÍA EL CORREO
         $autor = isset($_SESSION['usuario']['nombre']) ? $_SESSION['usuario']['nombre']. ' ' .$_SESSION['usuario']['apellidos'] : $_SESSION['usuario']['username'];
            
         if (empty($_SESSION['usuario']['correo'])) {
            $res['error'] = true;
            $res['msg']   = 'No tienes registrado un correo en el sistema';
            break;
         }

         // ENVÍA EL CORREO A MULTIPLES USUARIOS
         $c->enviarEmail($data, $autor);
         $res['error'] = false;
         break;

      case 'cotizacion_manual':
         $data = $_POST;
         $data['usuario_id'] = (int) $_SESSION['usuario']['id_usuario'];
         $evento = $c->getEvento($_POST['evento_id']);

         foreach ($evento[0] as $i => $e) {
            $data[$i] = $e;
         }

         $insert = $c->cotizacionManual($data);

         if (!$insert) {
            $res['error'] = true;
            $res['msg'] = $_SESSION['error']['msg'];
            unset($_SESSION['error']);
            break;
         }

         $res['error'] = false;
         break;
      
      default:
         $res['error'] = true;
         $res['msg']   = 'No se especificó la acción';
   }
} else {
   $res['msg']   = 'No se reconoció el comando';
   $res['error'] = true;
}

?>