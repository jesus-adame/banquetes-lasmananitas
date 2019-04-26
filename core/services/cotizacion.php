<?php
include 'models/CotizacionModel.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$c = new Cotizacion();
/**
 * MENÚ DEL SERVICIO EVENTOS
 */
switch ($action) {
   /**
    * INSERTA UN EVENTO Y COTIZACIÓN
    */
   case 'insert_event':
      try {
         // VALIDA LOS DATOS POST
         if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email'])) {
            throw new Exception('Hay campos vacios');
         }

      } catch (Exception $e) {
         $res['msg']   = "Error al registrar el cliente";
         $res['log']   = $th->getMessage();
         $res['error'] = true;
         break;
      }
      // INICIA UNA TRANSACCIÓN
      Conexion::beginTransaction();

      try {
         // VALIDA SI EXISTE EL CORREO
         $is_email = $c->isEmail($_POST['email']);
         
         if ($is_email) {
            // SI EXISTE EL CORREO VALIDA SI ES EL PROPIETARIO
            $is_cliente = $c->isCliente($_POST['nombre'], $_POST['apellido'], $_POST['email']);

            // SI NO ES EL PROPIETARIO DEL CORREO TIRA UN ERROR
            if (!$is_cliente) {
               throw new Exception('Ya hay otro cliente con ese correo');
            }
            // OBTIENE EL ID DEL CLIENTE
            $cliente_id = $c->getClienteId($_POST['email']);

         } else {
            // SI NO EXISTE EL CORREO EN LA DB INSERTA EL CLIENTE
            $c->insertCliente();
            $cliente_id = Conexion::lastInsertId();
         }

      } catch (PDOException $th) {
         $res['msg']   = "Error al registrar el cliente";
         $res['log']   = $th->getMessage();
         $res['error'] = true;
         Conexion::rollBack();
         break;
      }   
      // CAPTURA EL USUARIO EN SESSIÓN
      if (isset($_SESSION['usuario']['nombre']) && isset($_SESSION['usuario']['apellido'])) {
         $responsable = $_SESSION['usuario']['nombre']. ' ' .$_SESSION['usuario']['apellido'];

      } else {
         $responsable = $_SESSION['usuario']['username'];
      }
      // CREA UN ARRAY DE EVENTO
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
         // INSERTA UN EVENTO EN LA DB
         $c->insertEvento($data_evento);
         $evento_id = Conexion::lastInsertId();

         // INSERTA UNA COTIZACIÓN EN LA DB
         $c->insertCotizacion($evento_id, $cliente_id);
         $cotizacion_id = Conexion::lastInsertId();

         // FIN DE LA TRANSACCIÓN Y GUARDA LOS CAMBIOS
          $res['error'] = false;
          $res['data']  = array('evento_id' => $evento_id);
          Conexion::commit();
         
      } catch (PDOException $e) {
         $res['msg']   = 'Error en la operación';
         $res['log']   = $e->getMessage();
         $res['error'] = true;
         Conexion::rollBack();
      }
      break;
   
   /**
    * OBTIENE TODAS LAS COTIZACIONES
    */
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

   /**
    * OBTIENES LOS PRECIOS TOTALES DE UNA COTIZACIÓN
    */
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

   /**
    * INSERTA UNA COTIZACIÓN
    */
   case 'insertar_cotizacion':
      $evento_id  = $_POST['evento_id'];
      $cliente_id = $_POST['cliente_id'];

      try {
         // INSERTA LA COTIZACIÓN EN LA DB
         $insert = $c->insertCotizacion($evento_id, $cliente_id);
         $res['error'] = false;

         // MANEJA LOS ERRORES
      } catch (PDOException $e) {
         $res['error'] = true;
         $res['msg']   = 'Ocurrió un error';
         $res['log']   = $e->getMessage();

      } catch (Exception $e) {
         $res['error'] = true;
         $res['msg']   = $e->getMessage();
      }
      break;
   
   /**
    * CAMBIA EL STATUS DE UNA COTIZACIÓN
    */
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
   
   /**
    * ENVÍA UN EMAIL
    */
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

   /**
    * INSERTA UNA COTIZACIÓN DE FORMA MANUAL
    */
   case 'cotizacion_manual':
      $data = $_POST;
      $data['usuario_id'] = (int) $_SESSION['usuario']['id_usuario'];
      $evento = $c->getEvento($_POST['evento_id']);

      // RELLENA EL ARRAY CON TODOS LOS DATOS NECESARIOS
      foreach ($evento[0] as $i => $e) {
         $data[$i] = $e;
      }
      $insert = $c->cotizacionManual($data);

      // SI HAY ERRORES LOS MUESTRA
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