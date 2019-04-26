<?php

    class Utils {
        public static function isAdmin() {
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'Administrador') {
                header('location: '. base_url);
            }
        }

        public static function isSupervisor() {
            if (!isset($_SESSION['usuario']) ||
            ($_SESSION['usuario']['rol'] != 'Administrador' && $_SESSION['usuario']['rol'] != 'Supervisor'))
            {
                header('location: '. base_url);
            }
        }

        public static function isVentas() {
            if (!isset($_SESSION['usuario']) ||
            ($_SESSION['usuario']['rol'] != 'Administrador' && $_SESSION['usuario']['rol'] != 'Ventas') &&
            $_SESSION['usuario']['rol'] != 'Supervisor')
            {
                header('location: '. base_url);
            }
        }

        public static function isUser() {
            if (!isset($_SESSION['usuario'])) {
                header('location: '. base_url);
            }
        }

        public static function getConstantSmarty($smarty_obj, $view) {
            /** CREAMOS EL OBJETO DE USARIO */
            $usuario = null;
            
            if (isset($_SESSION['usuario'])) {
                $usuario = $_SESSION['usuario'];
            }
            
            $smarty_obj->assign('base_url', base_url);
            $smarty_obj->assign('view_url', $view);
            $smarty_obj->assign('usuario', $usuario);
            
            /** RUTAS SMARTY */
            $smarty_obj->assign('views', VIEWS_PATH);
            $smarty_obj->assign('inc', PUBLIC_PATH . 'includes/');
            $smarty_obj->assign('temp', VIEWS_PATH);
            $smarty_obj->assign('js', JS_PATH);
        }
    } // FIN DE LA CLASE

?>