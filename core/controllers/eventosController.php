<?php

if ($_SESSION['usuario']['rol'] != 'Ventas' && $_SESSION['usuario']['rol'] != 'Supervisor'
    && $_SESSION['usuario']['rol'] != 'Administrador') {
    header('location:index.php?view=index');
}

?>
