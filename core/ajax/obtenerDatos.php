<?php
require_once '../config/conexion.php';
require_once '../models/TablasModel.php';

$tabla = $_POST['tabla'];
$obj_tabla = new Tabla($tabla);

if (isset($_POST['tabla2']) && isset($_POST['tabla3'])) {
    $data_json = $obj_tabla->obtener_datos_join_join($_POST['tabla2'], $_POST['on'], $_POST['tabla3'], $_POST['on2']);
    
} else {
    $data_json = $obj_tabla->obtener_datos();    
}

echo json_encode($data_json);