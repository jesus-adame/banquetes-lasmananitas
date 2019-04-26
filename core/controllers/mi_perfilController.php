<?php
    
    class Mi_perfilController {

        public function index() {
            Utils::isUser();
            return view('mi_perfil');
        }
    }