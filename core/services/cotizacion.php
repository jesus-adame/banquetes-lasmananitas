<?php
include 'models/CotizacionModel.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$c = new Cotizacion();

/** MENÚ DEL SERVICIO EVENTOS */
switch ($action) {
   /** INSERT */
   case 'insert_event':
      /** INICIA LA TRANSACCIÓN */
      Conexion::beginTransaction();
      
      try {         
         /** VALIDA LOS DATOS POST */
         if (empty($_POST['nombre']) || empty($_POST['apellido'])) {
            throw new Exception('Hay campos vacios');
         }
         /** VALIDA SI EXISTE EL CLIENTE */
         $is_cliente = $c->isCliente($_POST['nombre'], $_POST['apellido'], $_POST['email']);

         if ($is_cliente) {
            /** OBTIENE EL ID DEL CLIENTE EN CASO DE QUE EXISTA */
            $cliente_id = $c->getClienteId($_POST['email']);

         } else {
            /** INSERTA EL CLIENTE EN CASO DE QUE NO EXISTA */
            $c->insertCliente();
            $cliente_id = Conexion::lastInsertId();
         }
         
         /** SI CLIENTE ESTÁ VACIA, TIRA UN ERROR */
         if (empty($cliente_id)) {
            throw new Exception('No se pudo registrar el cliente');
         }

      } catch (PDOException $th) {
         $res['msg']   = "Error al registrar el cliente";
         $res['log']   = $th->getMessage();
         $res['error'] = true;
         /** ERROR SQL */
         Conexion::rollBack();
         break;

      } catch (Exception $th) {
         $res['msg']   = $th->getMessage();
         $res['error'] = true;
         /** ERROR PERSONALIZADO */
         Conexion::rollBack();
         break;
      }
      
      /** CAPTURA EL USUARIO EN SESSIÓN */
      if (isset($_SESSION['usuario']['nombre']) && isset($_SESSION['usuario']['apellido'])) {
         $responsable = $_SESSION['usuario']['nombre']. ' ' .$_SESSION['usuario']['apellido'];

      } else {
         $responsable = $_SESSION['usuario']['username'];
      }

      /** CREA UN ARRAY DE EVENTO */
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
      
      try {
         /** INSERTA UN EVENTO */
         $c->insertEvento($data_evento);
         $evento_id = Conexion::lastInsertId();

         /** INSERTA UNA COTIZACIÓN */
         $c->insertCotizacion($evento_id, $cliente_id);
         $cotizacion_id = Conexion::lastInsertId();

      } catch (PDOException $e) {
         $res['msg']   = 'Error en la operación';
         $res['log']   = $e->getMessage();
         $res['error'] = true;
         /** SI HAY ERRORES REALIZA UN ROLLBACK */
         Conexion::rollBack();
         break;
      }

      /** FIN DE LA TRANSACCIÓN Y GUARDA LOS CAMBIOS */
      Conexion::commit();
      $res['data']  = array('evento_id' => $evento_id);
      $res['error'] = false;
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

?>