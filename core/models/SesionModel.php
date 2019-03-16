<?php
class Sesion
{
  private $user;
  private $pass;
  private $datos;
  private $db;

  public function __construct($user, $pass)
  {
    $this->user = $user;
    $this->pass = $pass;
    $this->datos = array();
    $this->db = Conexion::conectar();
  }

  private function getArrayUser()
  {
    return array(
      'user' => $this->user,
      'pass' => $this->pass,
      'estado' => '1'
    );
  }

  public function iniciarSesion()
  {
    $data = $this->getArrayUser();

    $sql = "SELECT u.id_usuario, u.username, u.pass, u.nivel as 'rol', d.nombre, d.apellidos
    FROM usuarios u LEFT JOIN detalle_usuario d ON u.id_usuario = d.id_usuario
    WHERE username COLLATE utf8_bin = :user AND pass = :pass AND estado = :estado";

    $session = Conexion::query($sql, $data, true);

    if (count($session) > 0) {
      $_SESSION['usuario'] = $session[0];
      return true;
    } else {
      return false;
    }
  }
}
