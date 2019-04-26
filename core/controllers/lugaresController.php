<?php

    class LugaresController {
        
        public function index() {
            Utils::isUser();
            return view('lugares');
        }
    }