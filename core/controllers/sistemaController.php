<?php

    class SistemaController {
        
        public function index() {
            Utils::isUser();
            return view('sistema');
        }
    }