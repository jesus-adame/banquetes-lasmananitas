<?php

if (!isset($_SESSION['usuario'])) {
   unset($_GET['view']);
   header('location:index.php?view=index');
}

if ($_SESSION['usuario']['rol'] != 'Administrador') {
   header('location:index.php?view=index');
}

if ($_SESSION['usuario']['rol'] != 'Ventas' && $_SESSION['usuario']['rol'] != 'Supervisor'
   && $_SESSION['usuario']['rol'] != 'Administrador') {
   header('location:index.php?view=index');
}

?>