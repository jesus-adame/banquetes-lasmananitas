<?php header('Content-type: application/json');
require_once '../config/conexion.php';
include '../models/TablasModel.php';

$tabla = new Tabla($_POST['tabla']);

if (isset($_POST['orden']) && $_POST['orden'] == true) {
   $datos = $tabla->obtener_datos_orden($_POST['campo'], $_POST['valor']);

} else {
   $datos = $tabla->obtener_datos_donde($_POST['campo'], $_POST['valor']);
}

echo json_encode($datos);