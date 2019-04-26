<?php
    
    class PreciosController {

        public function index() {
            Utils::isUser();
            return view('precios');
        }
    }
