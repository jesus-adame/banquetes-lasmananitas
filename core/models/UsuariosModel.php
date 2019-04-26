<?php

class Usuario
{
    private $usuario;
    private $pass;

    public function __construct($usuario = '', $pass = '')
    {
        $this->usuario = $usuario;
        $this->pass    = $pass;
    }

    public function setName($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**---- INSERTAR USUARIO */
    public function insertarUsuario($nivel, $estado)
    {
        $data_usu = array(
            'usuario' => $this->usuario,
            'pass'    => $this->pass,
            'estado'  => $estado,
            'nivel'   => $nivel
        );

        if ($this->usuario == '' || $this->pass == '') {
            return false;
        }

        $sql = "INSERT INTO usuarios VALUES (null, :usuario, :pass, :nivel, :estado)";

        try {
            Conexion::query($sql, $data_usu);

        } catch (PDOException $e) {
            $_SESSION['error']['msg'] = $e->getMessage();
            return false;
        }
        return true;
    }

    /**---- EDITAR USUARIO ----------*/
    public function editarUsuario($id, $nivel, $estado)
    {
        $data_usu = array(
            'usuario' => $this->usuario,
            'nivel'   => $nivel,
            'estado'  => $estado,
            'id'      => $id
        );

        if ($this->usuario == '') {
            return false;
        }
        
        $sql = "UPDATE usuarios SET
        username         = :usuario,
        nivel            = :nivel,
        estado           = :estado
        WHERE id_usuario = :id";

        try {
            Conexion::query($sql, $data_usu);

        } catch (PDOException $e) {
            $_SESSION['error']['msg'] = $e->getMessage();
            return false;
        }
        return true;
    }

    /**----------- BORRAR USUARIO -------------*/
    public function borrarUsuario($id)
    {
        $sql = "DELETE FROM usuarios
        WHERE id_usuario = :id";

        try {
            Conexion::query($sql, array('id' => $id));

        } catch (PDOException $e) {
            $_SESSION['error']['msg'] = $e->getMessage();
            return false;
        }
        return true;
    }

    /**----- CAMBIAR CONTRASEÑA ----------*/
    function cambiarPass($id_usuario, $pass) {
        $sql = 'UPDATE usuarios SET
        pass = :pass WHERE id_usuario = :id';

        try {
            Conexion::query($sql, array(
                'pass' => $pass,
                'id'   => $id_usuario
            ));

        } catch (PDOException $e) {
            $_SESSION['error']['msg'] = $e->getMessage();
            return false;
        }
        return true;
    }

    /**----- VALIDAR AUTENTICIDAD DEL USUARIO -------*/
    function validar($id_usuario, $pass) {
        $sql = "SELECT id_usuario FROM usuarios
        WHERE id_usuario = :id_usuario AND pass = :pass";
        
        try {
            $valid = Conexion::query($sql, array(
                'id_usuario' => $id_usuario,
                'pass'       => $pass
            ), true);

        } catch (PDOException $e) {
            $_SESSION['error']['msg'] = $e->getMessage();
            return false;
        }

        if (count($valid) > 0) {
            return true;
        } else {
            $_SESSION['error']['msg'] = 'Su contraseña actual es incorrecta';
            return false;
        }
    }
}