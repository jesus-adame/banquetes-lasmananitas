<?php header('Content-type: application/json');
require_once '../config/conexion.php';
require_once '../models/TablasModel.php';
$campos = new Tabla('campos_ordenes');

$id = $_POST['id_orden'];

$dataJson = $campos->obtener_datos_donde('id_orden', $id);

if (sizeof($dataJson))
echo json_encode($dataJson);
else
echo json_encode('no_data');