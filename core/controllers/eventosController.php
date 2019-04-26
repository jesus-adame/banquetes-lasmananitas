<?php

    class EventosController {
        
        public function index() {
            Utils::isVentas();
            return view('eventos');
        }
    }