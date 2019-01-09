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
    $sql = "SELECT * FROM usuarios as u INNER JOIN usuario_empleado as ue
    ON u.id_usuario = ue.id_usuario
    WHERE u.nombre_usuario = :user AND pass = :pass";

    $statement = $this->db->prepare($sql);
    $statement->execute(array(
      'user' => $this->user,
      'pass' => $this->pass
    ));

    $res = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($res) > 0) {
      foreach ($res as $key) {
        $_SESSION['id_usuario'] = $key['id_usuario'];
        $_SESSION['id_empleado'] = $key['id_empleado'];
        $_SESSION['usuario'] = $key['nombre_usuario'];
        $_SESSION['puesto'] = $key['puesto'];
      }

      return 1;
    } else {
      return 0;
    }
  }
}
?>
