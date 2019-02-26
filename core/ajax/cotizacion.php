<?php

   include '../config/conexion.php';
   include '../models/TablasModel.php';
   include '../models/CotizacionModel.php';

   /** CAPTURA DE DATOS */
   $data = array(
      'cliente' => $_POST['cliente'],
      'telefono' => $_POST['telefono'],
      'email' => $_POST['email'],
      'pax' => abs($_POST['pax']),
      'id_lugar' => intval($_POST['id_lugar']),
      'fecha_inicio' => $_POST['fecha_inicio']. ' ' .$_POST['tiempo_inicio'],
      'fecha_final' => $_POST['fecha_final']. ' ' .$_POST['tiempo_final']
   );

   /** RESPUESTA DEL SERVIDOR */
   $res = array(
      'msg' => '',
      'event' => '',
      'error' => false
   );

   if (!empty($data['cliente']) && !empty($data['telefono']) &&
   !empty($data['email']) && !empty($data['pax']) &&
   !empty($data['id_lugar']) && !empty($data['fecha_inicio']) && !empty($data['fecha_final'])) {

      $cot = new Cotizacion($data);

      $reservaciones = $cot->verificarEspacio();

      /** VERIFICA QUE NO ESTÉ RESERVADO EL LUGAR */
      if (sizeof($reservaciones, 0) >= 1) {
         $res['msg'] = 'El salón está ocupado en la fecha solicitada';
         $res['error'] = true;

      } else {
         $evento = $_POST['tipo_evento'];
         $precio = showPrecio($data['id_lugar'], $evento);

         $dia = date('w', strtotime($_POST['fecha_inicio']));
         $mes = date('n', strtotime($_POST['fecha_inicio']));

         /** VALIDAR TEMPORADA ALTA **/
         if ($dia === '6' && $mes === '2' || $mes === '3' || $mes === '4'
         || $mes === '5' || $mes === '10' || $mes === '11') {
            
            if ($precio['precio_alta'] > 0) { // VALIDA QUE TENGA UN PRECIO MAYOR A CERO
               $res['msg'] = 'El salon esta libre.<br/><br/>Precio temporada alta:<br/> $ '
               . $precio['precio_alta'];
               
            } else {
               $res['msg'] = 'No se ha registrado un precio del salón para ese tipo de evento';
               $res['error'] = true;
            }
            
         } else {
            
            if ($precio['precio_baja'] > 0) {
               $res['msg'] = 'El salon esta libre.<br/><br/>Precio temporada baja:<br/> $ '
               . $precio['precio_baja'];
               
            } else {
               $res['msg'] = 'No se ha registrado un precio del salón para ese tipo de eventos';
               $res['error'] = true;
            }
         }      
      }
   } else {
      $res['msg'] = 'Debe llenar todos los campos';
      $res['error'] = true;
   }
   
   /** SE EJECUTA SI NO HAY ERRORES, GUARDA EL LOG */
   if (!$res['error']) {
      $cot->crearLog($evento);

      /** SE OBTIENE EL EVENTO SELECCIONADO */
      $t = new Tabla('tipo_eventos');
      $event_reg = $t->obtener_datos_donde('id_tipo_evento', $evento);
      $res['event'] = strtoupper($event_reg[0]['nombre_tevento']);
   }

   header('Content-type:aplication/json');
   echo json_encode($res);

   /**
    * FUNCIONES DE COTIZACIONES
    */

   function showPrecio($id_lugar, $id_tevento) {
      $sql = "SELECT precio_alta, precio_baja FROM precios_renta
      WHERE id_tipo_evento = :id_tevento AND id_lugar = :id_lugar";

      $array = array(
         'id_tevento' => $id_tevento,
         'id_lugar' => $id_lugar
      );

      $res = Conexion::query($sql, $array, true, true);
      return $res;
   }

?>