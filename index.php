<?php

  session_start();
  include './core/lib/smarty/Smarty.class.php';
  include './core/config/conexion.php';

  $view = isset($_GET['view']) ? $_GET['view'] : 'index';

  if (is_file('./core/controllers/'. $view .'Controller.php')) {
    include './core/controllers/'. $view .'Controller.php';
  } else {
    include './core/controllers/errorController.php';
  }

?>
