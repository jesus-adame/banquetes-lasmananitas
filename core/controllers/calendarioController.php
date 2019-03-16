<?php

if (!isset($_SESSION['usuario'])) {
    unset($_GET['view']);
    header('location:index.php?view=index');
}

?>
