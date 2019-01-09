<?php header('Content-type: application/json');
require '../config/conexion.php';
include '../models/TablasModel.php';
$lugares = new Tabla('lugares');

$res = $lugares->obtener_datos();
if ($res) {
echo json_encode($res);
} else { echo json_encode('fail'); }