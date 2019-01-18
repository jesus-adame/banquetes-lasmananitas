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

  public function iniciarSesion()
  {
    $sql = "SELECT * FROM usuarios
    WHERE username = :user AND pass = :pass AND estado = :estado";

    $statement = $this->db->prepare($sql);
    $statement->execute(array(
      'user' => $this->user,
      'pass' => $this->pass,
      'estado' => '1'
    ));

    $res = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($res) > 0) {
      foreach ($res as $key) {
        $_SESSION['id_usuario'] = $key['id_usuario'];
        $_SESSION['usuario'] = $key['username'];
        $_SESSION['puesto'] = $key['nivel'];
      }

      return 1;
    } else {
      return 0;
    }
  }
}
?>
