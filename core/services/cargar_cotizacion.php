<?php

include 'models/CotizacionModel.php';

if (isset($_POST['action'])) {
   $cot = new Cotizacion(0);

   /** MENÚ DEL SERVICIO EVENTOS */
   switch ($_POST['action']) {
      case 'insertar_cotizacion':
         $cotizacion_id = $cot->getCotId($_POST['folio']);
         $insert        = $cot->insertDetalleCotizacion($cotizacion_id);

         if ($insert === true) {
            $res['msg']   = 'Se insertaron los datos';
            $res['error'] = false;
            
         } else {
            $res['data']  = null;
            $res['msg']   = $_SESSION['error'];
            $res['error'] = true;
         }
         unset($_SESSION['error']);
         break;

      case 'obtener_cotizacion':
         if (isset($_POST['cot']) && isset($_SESSION['usuario'])) {
            $cotizacion = $cot->getCotizacion($_POST['cot'], $_SESSION['usuario']['id_usuario']);

            if (count($cotizacion) > 0) {
               $detalle = $cot->getDetalleCotizacion($cotizacion[0]['id']);
               $res['cotizacion'] = $cotizacion[0];
               $res['detalle']    = $detalle;
               $res['error']      = false;
               $res['msg']        = 'validación correcta';

            } else {
               $res['error'] = true;
               $res['msg']   = 'No puedes ver los detalles de esta cotización';
            }

         } else {
            $res['error'] = true;
            $res['msg']   = 'No tiene permitido acceder a esta sección';
         }
         break;
         
      case 'borrar_detalle':
         $delete = $cot->deleteDetalleCot($_POST['detalle_id']);

         if ($delete == true) {
            $res['error'] = false;
            $res['msg']   = 'Elemento borrado';

         } else {
            $res['msg'] = 'Nose pudo borrar';
         }
         break;

      default;
         $res['error'] = true;
         $res['msg']   = 'No se reconoció la acción';
         break;
   }
} else {
   $res['msg']   = 'No se reconoció el comando';
   $res['error'] = true;
}
