<?php

    /**
     * Permite cargar una vista en un controlador
     * @param $view - Nombre de la vista
     * @param $variables - Array de variables para usar en las vistas
     * @return $smarty - Objeto smarty
     */
    function view($view, $varibles = array()) {

        // Se crea un objeto smarty para las vistas
        $smarty = new Smarty();

        Utils::getConstantSmarty($smarty, $view);
        
        // Carga las variables en la vista
        if (count($varibles) > 0) {

            // Arrary asociativo preferentemente
            foreach($varibles as $name => $value) {
                $smarty->assign($name, $value);
            }
        }

        // Crea la ruta de la vista
        if (is_file(VIEWS_PATH . $view . '/' . $view . '.html')) {
            $template = VIEWS_PATH . $view . '/' . $view . '.html';
            
        } else {
            $template = VIEWS_PATH . 'error-404.html';
        }

        // Devuelve la vista
        return $smarty->display($template);
    }
