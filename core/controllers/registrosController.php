<?php
    
    include 'core/models/TablasModel.php';

    class RegistrosController {
    
        public function index() {
            Utils::isAdmin();
            $tabla = new Tabla('usuarios');
            $usuarios = $tabla->obtener_datos();
            
            return view('registros', ['usuarios' => $usuarios]);
        }
    }


 