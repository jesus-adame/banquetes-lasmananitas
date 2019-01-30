<?php

    include '../config/conexion.php';
    include '../models/CotizacionModel.php';

    $data = array(
        'cliente' => $_POST['cliente'],
        'telefono' => intval($_POST['telefono']),
        'email' => $_POST['email'],
        'pax' => abs(intval($_POST['pax'])),
        'id_lugar' => intval($_POST['id_lugar']),
        'fecha_inicio' => $_POST['fecha_inicio'],
        'fecha_final' => $_POST['fecha_final']
    );

    if (!empty($data['cliente']) && !empty($data['telefono']) &&
    !empty($data['email']) && !empty($data['pax']) &&
    !empty($data['id_lugar']) && !empty($data['fecha_inicio']) && !empty($data['fecha_final'])) {

        $cot = new Cotizacion($data);

        $disponible = $cot->verificarEspacio();

        if (sizeof($disponible) >= 1) {

            showJSON('El salón está ocupado en la fecha solicitada');
        } else {
            showJSON('El salon esta libre en esa fecha');
        }
        //showJSON($data);
    } else {
        showJSON('empty_fields');
    }


    function showJSON($text) {
        echo json_encode($text);
    }

?>