<?php
    
    class AdminController {

        public function index() {
            Utils::isAdmin();
            return view('admin');
        }
    }