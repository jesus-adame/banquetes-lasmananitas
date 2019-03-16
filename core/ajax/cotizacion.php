<?php

   include '../config/conexion.php';
   include '../models/TablasModel.php';
   include '../models/CotizacionModel.php';

   /**----------- RESPUESTA DEL SERVIDOR */
   $res = array(
      'msg' => '',
      'data' => '',
      'event' => '',
      'error' => false
   );

   if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['telefono']) &&
   !empty($_POST['email']) && !empty($_POST['pax']) &&
   !empty($_POST['id_lugar']) && !empty($_POST['fecha_inicio']) && !empty($_POST['fecha_final'])) {

      $cot = new Cotizacion;

      /**---------- VALIDAR DISPONIBILIDAD */
      $disponible = $cot->verificarEspacio();

      /**----------- VERIFICA QUE NO ESTÉ OCUPADO EL LUGAR */
      if (!$disponible || $disponible == false) {
         $res['msg'] = 'El salón está ocupado en la fecha solicitada';
         $res['error'] = true;

      } else {
         $evento = $_POST['tipo_evento'];
         $dia = date('w', strtotime($_POST['fecha_inicio']));
         $mes = date('n', strtotime($_POST['fecha_inicio']));

         /**----------- OBTENER PRECIO POR TEMPORADA ALTA O BAJA **/
         $precio = $cot->getPrecioRenta($dia, $mes, $evento, $_POST['id_lugar']);
         $res['msg'] = $precio['msg'];
         $res['data'] = $precio['precio'];
         $res['error'] = false;

         if ($precio['error']) {
            $res['error'] = true;
         }
      }
   } else {
      $res['msg'] = 'Debe llenar todos los campos';
      $res['error'] = true;
   }
   
   if (!$res['error']) {

      /** SE OBTIENE EL TIPO DE EVENTO REGISTRADO */
      $t = new Tabla('tipo_eventos');
      $event_reg = $t->obtener_datos_donde('id_tipo_evento', $evento);
      $res['event'] = strtoupper($event_reg[0]['nombre_tevento']);
   }

   header('Content-type: aplication/json');
   echo json_encode($res);

?>