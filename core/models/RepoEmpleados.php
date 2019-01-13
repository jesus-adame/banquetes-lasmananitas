<?php
class RepoEmpleados
{
    private $data;
    private $db;

    public function __construct()
    {
        $this->data = array();
        $this->db = Conexion::conectar();
    }
}