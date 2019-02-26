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

    public function insertarUsuario($nivel, $estado)
    {
        if ($this->usuario == '' || $this->pass == '') {
            return 0;
        }

        $sql = "INSERT INTO usuarios (
            username,
            pass,
            estado,
            nivel) VALUES (
            :usuario,
            :pass,
            :estado,
            :nivel)";

        $exe = $this->db->prepare($sql);
        $exe->execute(array(
            'usuario' => $this->usuario,
            'pass' => $this->pass,
            'estado' => $estado,
            'nivel' => $nivel
        ));

        if ($exe) {
            return 1;
        } else {
            return 0;
        }
    }

    public function editarUsuario($id, $nivel, $estado)
    {
        if ($this->usuario == '') {
            return 0;
        }
        
        $sql = "UPDATE usuarios SET
        username = :usuario,
        nivel = :nivel,
        estado = :estado WHERE id_usuario = :id";

        $exe = $this->db->prepare($sql);
        $exe->execute(array(
            'usuario' => $this->usuario,
            'nivel' => $nivel,
            'estado' => $estado,
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

    function cambiarPass($id_usuario, $pass) {
        $sql = 'UPDATE usuarios SET
        pass = :pass WHERE id_usuario = :id';

        $exe = $this->db->prepare($sql);
        $exe->execute(array(
            'pass' => $pass,
            'id' => $id_usuario
        ));

        if ($exe) { return 1; }
        else { return 0; }
    }

    function validar($id_usuario, $pass) {
        $sql = "SELECT id_usuario FROM usuarios
        WHERE id_usuario = :id_usuario AND pass = :pass";
  
        $exe = $this->db->prepare($sql);
        $exe->execute(array(
            'id_usuario' => $id_usuario,
            'pass' => $pass
        ));

        if (count($exe->fetchAll())) { return 1; }
        else { return 0; }
    }
}