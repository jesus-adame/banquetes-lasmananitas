<?php

 if ($_SESSION['usuario']['rol'] != 'Administrador') {
   header('location:index.php?view=index');
}