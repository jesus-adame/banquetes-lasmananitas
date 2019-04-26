<?php

	/**
	 * Front Controller
	 */
	session_start();
	require_once './core/config/parameters.php';
	require_once './core/helpers/Utils.php';
	require_once './core/helpers/Functions.php';
	require_once './core/helpers/Route.php';
	require_once './core/helpers/Router.php';
	require_once './core/config/conexion.php';
	require_once './core/lib/smarty/Smarty.class.php';
	require_once './core/lib/vendor/autoload.php';

	$router = new Router($_SERVER['REQUEST_URI']);

	// Recibe las rutas disponibles para usar
	include_once './routes/web.php';

	$router->run();