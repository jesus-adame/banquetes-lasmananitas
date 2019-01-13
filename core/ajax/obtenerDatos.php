<?php
require_once '../config/conexion.php';
require_once '../models/TablasModel.php';

$tabla = $_POST['tabla'];
$obj_tabla = new Tabla($tabla);
$data_json = $obj_tabla->obtener_datos();

echo json_encode($data_json);