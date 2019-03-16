<?php

include 'models/CotizacionModel.php';

if (isset($_POST['action'])) {
   $cot = new Cotizacion(0);

   /** MENÚ DEL SERVICIO EVENTOS */
   switch ($_POST['action']) {
      case 'insertar_cotizacion':
         $insert = $cot->insertCotizacion();
         $res['data'] = null;
         $res['msg'] = 'No se realizó la operación';
         $res['error'] = true;

         if ($insert != false) {
            $res['data'] = $insert;
            $res['error'] = false;
         }
         break;
   }
} else {
   $res['msg'] = 'No se reconoció el comando';
   $res['error'] = true;
}
