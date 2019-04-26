<?php

/** Controladores */
include './core/controllers/indexController.php';
include './core/controllers/calendarioController.php';
include './core/controllers/eventosController.php';
include './core/controllers/registrosController.php';
include './core/controllers/mi_perfilController.php';
include './core/controllers/adminController.php';
include './core/controllers/cotizacionController.php';
include './core/controllers/cargarCotizacionController.php';
include './core/controllers/lugaresController.php';
include './core/controllers/preciosController.php';
include './core/controllers/tipo_eventosController.php';
include './core/controllers/sistemaController.php';
include './core/controllers/ventasController.php';
include './core/controllers/imprimir_ordenController.php';
include './core/controllers/imprimir-cotizacionController.php';

/** RUTAS GET */
$router->add('/banquetes/', 'IndexController::index'); // INDEX
$router->add('/banquetes/calendario', 'CalendarioController::index'); // CALENDARIO
$router->add('/banquetes/eventos', 'EventosController::index'); // EVENTOS
$router->add('/banquetes/registros', 'RegistrosController::index'); // USARIOS
$router->add('/banquetes/admin', 'AdminController::index'); // ADMINISTRACIÓN
$router->add('/banquetes/mi_perfil', 'Mi_perfilController::index'); // MI PERFIL
$router->add('/banquetes/sistema', 'SistemaController::index'); // SISTEMA
$router->add('/banquetes/cotizacion', 'CotizacionController::index'); // COTIZACIONES
$router->add('/banquetes/precios', 'PreciosController::index'); // PRECIOS
$router->add('/banquetes/ventas', 'VentasController::index'); // VENTAS
$router->add('/banquetes/lugares', 'LugaresController::index'); // LUGARES
$router->add('/banquetes/tipo_eventos', 'Tipo_eventosController::index'); // TIPOS DE EVENTOS

$router->add('/banquetes/detalle-cotizacion&cot=:id', 'CargarCotizacionController::index');

$router->add('/banquetes/orden_pdf&id=:id', 'OrdenPdfController::index');

$router->add('/banquetes/cotizacion_pdf&folio=:id', 'ImprimirCotizacionController::index');

/** RUTAS POST */