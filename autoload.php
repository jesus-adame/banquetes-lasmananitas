<?php

define('ROOT', dirname(__FILE__));
    define('DS', DIRECTORY_SEPARATOR);

    function autoload_controller($class) {
        $class = ROOT . DS . str_replace("\\", DS, $class) . '.php';

        if (!file_exists($class)) {
            throw Exception("No se pudo cargar la clase");
        }
        require_once $class;
    }

    spl_autoload_register('autoload_controller');