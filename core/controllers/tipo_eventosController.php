<?php

    require_once 'core/models/TipoEvento.php';
    
    class Tipo_eventosController {
        
        public function index() {
            Utils::isAdmin();
            $tipoEve = new TipoEvento;
            $eventos = $tipoEve->getAll();

            return view('tipo_eventos', ['tipo_eventos' => $eventos]);
        }
    }