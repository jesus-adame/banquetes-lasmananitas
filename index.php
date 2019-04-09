<?php

  session_start();
  require_once './core/config/rutas.php';
  require_once './core/lib/vendor/autoload.php';
  require_once './core/lib/smarty/Smarty.class.php';
  require_once './core/config/conexion.php';

  /** CREAMOS EL OBJETO DE SMARTY */
  $html = new Smarty();
  $usuario = null;

  if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
  }

  $view = isset($_GET['view']) ? $_GET['view'] : 'index';
  $html->assign('view_url', $view);
  $html->assign('usuario', $usuario);

  /** RUTAS SMARTY */
  $html->assign('views', VIEWS_PATH);
  $html->assign('inc', VIEWS_PATH. 'inc/');
  $html->assign('temp', VIEWS_PATH. 'templates/');

  /** VERIFICA SI HAY UN CONTROLADOR DE LA PÁGINA */
  if (is_file('./core/controllers/' . $view . 'Controller.php')) {
    include './core/controllers/' . $view . 'Controller.php';
  }

  /** MUESTRA LA PÁGINA EN EL NAVEGADOR */
  if (is_file(VIEWS_PATH . $view . '.html')) {
    $html->display(VIEWS_PATH . $view . '.html');
    
  } else {
    $html->display(VIEWS_PATH .'error-404.html');
  }

?>