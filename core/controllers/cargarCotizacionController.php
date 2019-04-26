<?php

    class CargarCotizacionController {
        
        public function index($id) {
            Utils::isVentas();
            
            if (isset($id)) {
                $folio = ['folio' => $id];

            } else {
                $folio = [];
            }
            return view('cargar-cotizacion', $folio);
        }
    }

