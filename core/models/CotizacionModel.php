<?php
class Cotizacion
{
    /**--------------- OBTENER TODAS LA COTIZACIONES ----*/
    public function getAll($evento_id)
    {
        $sql = "SELECT co.folio, CONCAT(cl.nombre, ' ', cl.apellido) as 'cliente', CONCAT(u.username) as 'usuario',
        co.fecha, co.renta, co.personas, co.estado, co.renta + SUM(d.subtotal) as 'total' 
        FROM cotizaciones co INNER JOIN clientes cl ON co.cliente_id = cl.id
        INNER JOIN usuarios u ON co.usuario_id = u.id_usuario
        LEFT JOIN detalle_cotizacion d ON co.id = d.cotizacion_id
        WHERE co.evento_id = :evento_id
        GROUP BY co.id;";

        $select = Conexion::query($sql, array('evento_id' => $evento_id), true);
        return $select;
    }

    /**--------------------- FUNCIONES PRIVADAS -----------*/
    private function getArrayDisponib() {
        return array(
            'inicio' => $_POST['fecha_inicio'] .' '. $_POST['tiempo_inicio'],
            'final' => $_POST['fecha_final'] .' '. $_POST['tiempo_final'],
            'id_lugar' => intval($_POST['id_lugar']),
            'color' => '#d7c735'
        );
    }
    
    private function getArrayCot() {
        $evento_id = isset($_POST['evento_id']) ? $_POST['evento_id'] : '';
        $folio = $this->createFolio();

        return array(
            'evento_id' => $evento_id,
            'cliente_id' => isset($_POST['cliente_id']) ? $_POST['cliente_id'] : '',
            'usuario_id' => (int) $_SESSION['usuario']['id_usuario'],
            'folio' => $folio,
            'renta' => $_POST['renta'],
            'pax' => abs($_POST['pax']),
            'estado' => 0,
            'costo_total' => $_POST['renta']
        );
    }

    private function getArrayDetalleCot() {
        $array = array();
        $count = count($_POST['descripcion']);

        foreach ($_POST['descripcion'] as $d) {
            if (empty($d)) { return null; }
        }
        
        for ($i = 0; $i < $count; $i++) {
            $descripcion = $_POST['descripcion'][$i];
            $cantidad = isset($_POST['cantidad'][$i]) ? (int) $_POST['cantidad'][$i] : 0;
            $precio = isset($_POST['precio'][$i]) ? (float) $_POST['precio'][$i] : 0;
            $subtotal = $cantidad * $precio;

            array_push($array, array(
                'descripcion' => $descripcion,
                'precio_unitario' => $precio,
                'cantidad' => $cantidad,
                'servicio' => 0,
                'iva' => 0,
                'subtotal' => $subtotal
            ));
        }
        return $array;
    }

    private function getArrayCliente() {
        return array(
            'nombre' => strtoupper($_POST['nombre']),
            'apellido' => strtoupper($_POST['apellido']),
            'email' => $_POST['email'],
            'telefono' => $_POST['telefono'],
        );
    }

    /**----------------------- VALIDAR DISPONOBILIDAD ------------------*/
    public function verificarEspacio() {
        $data = $this->getArrayDisponib();
        $validacion = true;

        /*------- CHECA SI HAY EVENTOS QUE ATRAVIEZAN LAS FECHAS INICIO O FINAL -----*/
        $sql = "SELECT title FROM eventos WHERE ((:inicio BETWEEN start and end) OR
        (:final BETWEEN start and end)) AND
        (id_lugar = :id_lugar AND color != :color)";

        $is_event = count(Conexion::query($sql, $data, true));

        if ($is_event) {
            $validacion = false;

        } else {
            /*------ CHECA SI HAY EVENTOS QUE EMPIECEN O TERMINEN ENTRE DE LAS FECHAS INICIO O FINAL ------*/
            $sql = "SELECT title FROM eventos WHERE ((start between :inicio and :final) OR 
            (end between :inicio and :final)) AND
            (id_lugar = :id_lugar AND color != :color)";

            $is_event = Conexion::query($sql, $data, true);
            
            if (count($is_event) > 0) {
                $validacion = false;
            }
        }
        return $validacion;
    }

    /**------------------------ INSERT COTIZACION ----------------------------*/
    public function insertCotizacion($evento_id, $cliente_id) {
        $data = $this->getArrayCot();
        $data['evento_id'] =$evento_id;
        $data['cliente_id'] = $cliente_id;
        $validacion = $this->validaFolioCot($data['folio']);
        $result = false;

        if ($validacion) {
            $sql = "INSERT INTO cotizaciones VALUES
            (null, :evento_id, :cliente_id, :usuario_id, :folio, NOW(), :renta, :pax, :estado, :costo_total)";

            $result = Conexion::query($sql, $data);
        }
        return $result;
    }

    /*------------------------- INSERT CLIENTE -----------------------------*/

    public function insertCliente() {
        $d = $this->getArrayCliente();
        $exist = $this->isCliente($d['nombre'], $d['apellido'], $d['email']);
        $result = null;

        if ($exist) {
            $cliente_id = $this->getClienteId($d['nombre'], $d['apellido'], $d['email']);
            
            $result = $cliente_id;
            
        } else {
            $sql = "INSERT INTO clientes VALUES
            (null, :nombre, :apellido, :email, :telefono, NOW())";

            $insert = Conexion::query($sql, $d);
            $result = $insert->lastInsertId();
        }
        /** DEVUELVE EL ID DEL CLIENTE */
        return $result;
    }

    /**------------------------- INSERT EVENTO -----------------------------*/

    public function insertEvento($data) {
        $sql = "INSERT INTO eventos VALUES
        (null, :title, :evento, null, :contacto, :cord_resp, null, null, :id_lugar, :start, :end, :personas, :categoria, :color, :id_usuario)";

        $insert = Conexion::query($sql, $data);
        return $insert->lastInsertId();
    }

    /**---------------------- INSERT DETALLE COTIZACIÓN ------------------*/

    public function insertDetalleCotizacion($cotizacion_id) {
        $data = $this->getArrayDetalleCot();

        if ($data == null) { return false; }

        $sql = "INSERT INTO detalle_cotizacion VALUES
        (null, :cotizacion_id, :descripcion, :precio_unitario, :cantidad, :servicio, :iva, :subtotal)";

        foreach ($data as $detalle) {
            $detalle['cotizacion_id'] = $cotizacion_id;

            try {
                $insert = Conexion::query($sql, $detalle);

            } catch (PDOExeption $e) {
                if ($insert->errorCode() !== 0) {
                    return "Syntax Error: ". $e->getMessage();
                }

            }
        }
        return true;
    }

    /**----------------------- OBTENER PRECIO RENTA ----------------*/
    public function getPrecioRenta($dia, $mes, $id_tevento, $id_lugar) {
        $precio = 0;
        $precio_result = array(
            'msg' => '',
            'precio' => 0,
            'error' => false
        );

        $sql = "SELECT id_precio, precio_alta, precio_baja FROM precios_renta
        WHERE id_tipo_evento = :id_tevento AND id_lugar = :id_lugar";

        $is_precio = Conexion::query($sql, array('id_tevento' => $id_tevento, 'id_lugar' => $id_lugar), true);

        if (count($is_precio) < 1) {
            $precio_result['msg'] = 'No se ha registrado un precio del salón para ese tipo de evento';
            $precio_result['error'] = true;
            return $precio_result;

        } else {
            /** OBTIENE EL PRECIO EN LA POSICION 0 */
            $precio_result['msg'] = 'El salon esta libre.<br/><br/>Precio ';
            $precio = $is_precio[0];
        }

        if ($dia === '6' && $mes === '2' || $mes === '3' || $mes === '4' ||
            $mes === '5' || $mes === '10' || $mes === '11') {

            $precio_result['msg'] .= '(temporada alta)<br/>$ '. $precio['precio_alta'];
            $precio_result['precio'] = $precio['precio_alta'];

        } else {
            $precio_result['msg'] .= '(temporada baja)<br/>$ '. $precio['precio_baja'];
            $precio_result['precio'] = $precio['precio_alta'];
        }
        return $precio_result;
    }

    /**---------------------- OBTENER DATA CLIENTE ----------------------*/
    public function getCliente($cliente_id) {
        $sql = "SELECT nombre, apellido FROM clientes WHERE id_cliente = :cliente_id";

        $cliente = Conexion::query($sql, array('cliente_id' => $cliente_id), true, true);
        return $cliente;
    }

    /**---------------------- OBTENER CLIENTE ID ----------------------*/
    public function getClienteId($nombre, $apellido, $email)
    {
        $sql = "SELECT id FROM clientes WHERE nombre = :nombre AND apellido = :apellido AND email = :email";

        $cliente_id = Conexion::query($sql, array('nombre' => $nombre, 'apellido' => $apellido, 'email' => $email), true, true);
        return $cliente_id;
    }

    /**---------------------- OBTENER USUARIO ----------------------*/
    public function getUsuario($usuario_id)
    {
        $sql = "SELECT nombre, apellidos FROM usuarios u
        INNER JOIN detalle_usuario d ON d.id_usuario = u.id_usuario
        WHERE u.id_usuario = :usuario_id";

        $usuario = Conexion::query($sql, array('usuario_id' => $usuario_id), true, true);
        return $usuario;
    }

    /**------------------------ OBTENER EVENTO --------------------*/
    public function getEvento($evento_id) {
        $sql = "SELECT title, evento, personas, categoria FROM eventos
        WHERE id_evento = :evento_id";

        $evento = Conexion::query($sql, array('evento_id' => $evento_id));
        return $evento;
    }

    /**------------------------- OBTENER COTIZACIÓN -------------------*/

    public function getCotizacion($cotizacion_folio, $usuario_id) {
        $sql = "SELECT c.id, c.folio, c.fecha, e.title as 'evento', e.contacto, c.usuario_id, c.renta, e.personas as 'pax' FROM cotizaciones c
        INNER JOIN eventos e ON c.evento_id = e.id_evento
        WHERE c.folio = :folio AND c.usuario_id = :usuario";

        $cotizacion = Conexion::query($sql, array('folio' => $cotizacion_folio, 'usuario' => $usuario_id), true);
        return $cotizacion;
    }

    /**------------------------- OBTENER DETALLE COTIZACIÓN -------------------*/

    public function getDetalleCotizacion($cotizacion_id)
    {
        $sql = "SELECT id, descripcion, precio_unitario, cantidad, subtotal FROM
        detalle_cotizacion WHERE cotizacion_id = :cotizacion_id";

        $detalle = Conexion::query($sql, array('cotizacion_id' => $cotizacion_id), true);
        return $detalle;
    }

    /**----------------------- OBTENER EL TOTAL DE LA COTIZACION --------------*/
    public function getTotalCotizacion($folio) {
        $sql = "SELECT c.renta, SUM(d.subtotal) as 'alimentos', c.costo_total + SUM(d.subtotal) as 'total' FROM detalle_cotizacion d INNER JOIN cotizaciones c ON d.cotizacion_id = c.id
        WHERE c.folio = :folio;";

        $select = Conexion::query($sql, array('folio' => $folio), true);
        if (count($select) > 0) {
            return $select[0];
        } else {
            return null;
        }
    }

    /**------------------------ OBTENER VALIDACION --------------------*/
    public function getValidacionRenta($validacion_id) {
        $sql = "SELECT * FROM validaciones_renta WHERE id = :validacion_id";

        $rentaData = Conexion::query($sql, array('validacion_id' => $validacion_id));
        return $rentaData;
    }

    /**------------------------ OBTENER FOLIO COTIZACION --------------------*/
    private function validaFolioCot($folio_id) {
        $sql = "SELECT folio FROM cotizaciones WHERE id = :folio_id";
        $cotizacion = Conexion::query($sql, array('folio_id' => $folio_id), true);
        $validacion = true;

        if (count($cotizacion) > 0) {
            $validacion = false;
        }
        return $validacion;
    }

    /**------------------------ OBTENER ID COTIZACION --------------------*/
    public function getCotId($folio)
    {
        $sql = "SELECT id FROM cotizaciones WHERE folio = :folio";
        $cotizacion = Conexion::query($sql, array('folio' => $folio), true);

        if (count($cotizacion) > 0) {
            return (int) $cotizacion[0]['id'];
        }
        return false;
    }

    /**-------------------- VALIDA SI EXISTE UN CLIENTE -----------*/
    private function isCliente($nombre, $apellido, $email)
    {
        $sql = "SELECT nombre FROM clientes WHERE nombre = :nombre AND apellido = :apellido AND email = :email";

        $cotizacion = Conexion::query($sql, array('nombre' => $nombre, 'apellido' => $apellido, 'email' => $email), true);
        $cliente = false;

        if (count($cotizacion) > 0) {
            $cliente = true;
        }
        return $cliente;
    }

    /**------------------- CREAR FOLIO COTIZACIONES ---------*/
    private function createFolio()
    {
        $sql = "SELECT folio FROM cotizaciones ORDER BY folio LIMIT 1";

        $folio = (int) Conexion::query($sql, array(), true, true);

        if ($folio > 0) {
            return $folio + 1;
        } else {
            return 1;
        }
    }

    /**-------------------- BORRAR DETALLE COTIZACIÓN ----------*/
    public function deleteDetalleCot($detalle_id) {
        $sql = "DELETE FROM detalle_cotizacion WHERE id = :id";

        try {
           $delete = Conexion::query($sql, array('id' => $detalle_id));
           return true;

        } catch (PDOException $e) {
            if ($delete->errorCode() !== 0) {
            return "Syntax Error: ". $e->getMessage();
            }
        }
    }
}
