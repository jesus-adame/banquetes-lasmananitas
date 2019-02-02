<?php

    include '../config/conexion.php';
    include '../models/CotizacionModel.php';

    $data = array(
        'cliente' => $_POST['cliente'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email'],
        'pax' => abs($_POST['pax']),
        'id_lugar' => intval($_POST['id_lugar']),
        'fecha_inicio' => $_POST['fecha_inicio']. ' ' .$_POST['tiempo_inicio'],
        'fecha_final' => $_POST['fecha_final']. ' ' .$_POST['tiempo_final']
    );

    if (!empty($data['cliente']) && !empty($data['telefono']) &&
    !empty($data['email']) && !empty($data['pax']) &&
    !empty($data['id_lugar']) && !empty($data['fecha_inicio']) && !empty($data['fecha_final'])) {

        $cot = new Cotizacion($data);

        $disponible = $cot->verificarEspacio();

        if (sizeof($disponible) >= 1) {

            showJSON('El salón está ocupado en la fecha solicitada');
        } else {
            $evento = $_POST['tipo_evento'];
            $precio = showPrecio($data['id_lugar'], $evento);
            $str_response = '';

            $dia = date('w', strtotime($_POST['fecha_inicio']));
            $mes = date('n', strtotime($_POST['fecha_inicio']));

            $cot->crearLog($evento);

            /** VALIDAR TEMPORADA ALTA */
            if ($dia === '6' && $mes === '2' || $mes === '3' || $mes === '4' || $mes === '5'
            || $mes === '10' || $mes === '11') {
                $str_response = 'El salon esta libre.<br/><br/>Precio temporada alta:<br/> $ '. $precio['precio_alta'];
            } else {
                $str_response = 'El salon esta libre.<br/><br/>Precio temporada baja:<br/> $ '. $precio['precio_baja'];
            }
            
            showJSON($str_response);
        }
    } else {
        showJSON('empty_fields');
    }


    function showJSON($text) {
        echo json_encode($text);
    }

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