<?php

    class CalendarioController {

        public function index() {
            Utils::isUser();
            
            return view('calendario');
        }
    }