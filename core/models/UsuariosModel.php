<?php

class Usuario
{
    private $usuario;
    private $pass;
    private $db;

    public function __construct($usuario = '', $pass = '')
    {
        $this->usuario = $usuario;
        $this->db = Conexion::conectar();
        $this->pass = $pass;
    }

    public function setName($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function insertarUsuario()
    {
        if ($this->usuario == '' || $this->pass == '') {
            return 0;
        }

        $sql = "INSERT INTO usuarios (
            nombre_usuario,
            pass) VALUES (
            :usuario,
            :pass)";

        $exe = $this->db->prepare($sql);
        $exe->execute(array(
            'usuario' => $this->usuario,
            'pass' => $this->pass
        ));

        if ($exe) {
            return 1;
        } else {
            return 0;
        }
    }

    public function editarUsuario($id)
    {
        if ($this->usuario == '' || $this->pass == '') {
            return 0;
        }
        
        $sql = "UPDATE usuarios SET
        nombre_usuario = :usuario,
        pass = :pass WHERE id_usuario = :id";

        $exe = $this->db->prepare($sql);
        $exe->execute(array(
            'usuario' => $this->usuario,
            'pass' => $this->pass,
            'id' => $id
        ));

        if ($exe) {
            return 1;
        } else {
            return 0;
        }
    }

    public function borrarUsuario($id)
    {
        $sql = "DELETE FROM usuarios
        WHERE id_usuario = :id";

        $exe = $this->db->prepare($sql);
        $exe->execute(array(
            'id' => $id
        ));

        if ($exe) {
            return 1;
        } else {
            return 0;
        }
    }
}