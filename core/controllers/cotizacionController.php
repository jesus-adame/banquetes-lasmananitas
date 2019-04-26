<?php

    class CotizacionController {
        
        public function index() {
            Utils::isVentas();
            return view('cotizacion');
        }
    }