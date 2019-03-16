<?php

class Orden
{
  private $db;
  private $datos;

  public function __construct()
  {
    $this->db = Conexion::conectar();
    $this->datos = array();
  }

  private function getArrayData() {
    return array(
      'id_evento' => $_POST['id_evento'],
      'fecha' => $_POST['fecha']. ' ' .$_POST ['time'],
      'orden' => $_POST['nombre'],
      'garantia' => $_POST['garantia'],
      'lugar' => $_POST['lugar'],
      'montaje' => $_POST['montaje'],
      'canapes' => isset($_POST['canapes']) ? $_POST['canapes'] : '',
      'entrada' => isset($_POST['entrada']) ? $_POST['entrada'] : '',
      'fuerte' => isset($_POST['fuerte']) ? $_POST['fuerte'] : '',
      'postre' => isset($_POST['postre']) ? $_POST['postre'] : '',
      'bebidas' => isset($_POST['bebidas']) ? $_POST['bebidas'] : '',
      'cocteleria' => isset($_POST['cocteleria']) ? $_POST['cocteleria'] : '',
      'mezcladores' => isset($_POST['mezcladores']) ? $_POST['mezcladores'] : '',
      'detalle_montaje' => isset($_POST['detalle_montaje']) ? $_POST['detalle_montaje'] : '',
      'ama_llaves' => isset($_POST['ama_llaves']) ? $_POST['ama_llaves'] : '',
      'chief_steward' => isset($_POST['chief_steward']) ? $_POST['chief_steward'] : '',
      'mantenimiento' => isset($_POST['mantenimiento']) ? $_POST['mantenimiento'] : '',
      'seguridad' => isset($_POST['seguridad']) ? $_POST['seguridad'] : '',
      'proveedores' => isset($_POST['proveedores']) ? $_POST['proveedores'] : '',
      'recursos_humanos' => isset($_POST['recursos_humanos']) ? $_POST['recursos_humanos'] : '',
      'contabilidad' => isset($_POST['contabilidad']) ? $_POST['contabilidad'] : '',
      'observaciones' => isset($_POST['observaciones']) ? $_POST['observaciones'] : '',
      'tipo_formato' => isset($_POST['tipo_formato']) ? $_POST['tipo_formato'] : ''
    );
  }

  public function agregarOrden()
  {
    $data = $this->getArrayData();
    $v = $this->obtenerValidacionEvento($_SESSION['usuario']['id_usuario'], $data['id_evento']);

    if ($v === '1' || $_SESSION['usuario']['rol'] == 'Administrador') {
      
      $sql = "INSERT INTO ordenes_servicio VALUES (
        null, :id_evento, :fecha, :orden, :garantia,
        :lugar, :montaje, null, :canapes,
        :entrada, :fuerte, :postre, :bebidas,
        :cocteleria, :mezcladores, :detalle_montaje,
        :ama_llaves, :chief_steward, :mantenimiento,
        :seguridad, :proveedores, :recursos_humanos,
        :contabilidad, :observaciones, :tipo_formato,
        null)";
  
  $insert = Conexion::query($sql, $data);
  
  return $insert->lastInsertId();
} else { return 0; }

}

  public function eliminarOrden($id, $id_evento)
  {
    if ($this->obtenerValidacionEvento($_SESSION['usuario']['id_usuario'], $id_evento)
    || $_SESSION['usuario']['puesto'] == 'Administrador') {
      $sql = "DELETE FROM
      ordenes_servicio WHERE id_orden = :id";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'id' => $id
      ));

      return $exe;
    } else {return 0; }
  }

  public function modificarOrden($id)
  {
    $data = $this->getArrayData();
    $data['id'] = $id;

    if ($this->obtenerValidacionEvento($_SESSION['usuario']['id_usuario'], $data['id_evento'])
    || $_SESSION['usuario']['rol'] == 'Administrador') {
      $sql = "UPDATE ordenes_servicio SET
      id_evento = :id_evento,
      fecha = :fecha,
      orden = :orden,
      garantia = :garantia,
      lugar = :lugar,
      montaje = :montaje,
      canapes = :canapes,
      entrada = :entrada,
      fuerte = :fuerte,
      postre = :postre,
      bebidas = :bebidas,
      cocteleria = :cocteleria,
      mezcladores = :mezcladores,
      detalle_montaje = :detalle_montaje,
      ama_llaves = :ama_llaves,
      chief_steward = :chief_steward,
      mantenimiento = :mantenimiento,
      seguridad = :seguridad,
      recursos_humanos = :recursos_humanos,
      proveedores = :proveedores,
      contabilidad = :contabilidad,
      observaciones = :observaciones,
      tipo_formato = :tipo_formato WHERE id_orden = :id";

      $editar = Conexion::query($sql, $data);

      return $editar;
    } else { return 0; }
    
  }

  private function obtenerValidacionEvento($id_usu, $id_evento)
  {
    $data = array(
      'id_usu' => $id_usu,
      'id_evento' => $id_evento
    );

    $sql = "SELECT COUNT(*) as 'num' FROM eventos
    WHERE id_usuario = :id_usu AND id_evento = :id_evento";

    $v = Conexion::query($sql, $data, true, true);
    return $v['num'];
  }

  public function agregarCampoExtra($id_orden, $tag, $cont)
  {
    $sql = "INSERT INTO campos_ordenes (
      id_orden, tag, content
    ) VALUES (
      :id_orden, :tag, :content)";
    
    $exe = $this->db->prepare($sql);
    $exe->execute(array(
      'id_orden' => $id_orden,
      'tag' => $tag,
      'content' => $cont
    ));

    if ($exe) {
      return 1;
    } else { return 0; }

  }

  public function editarCampoExtra($id_campo, $tag, $cont)
  {
    $sql = "UPDATE campos_ordenes SET
      tag = :tag, content = :content
      WHERE id_campo = :id_campo";
    
    $exe = $this->db->prepare($sql);
    $exe->execute(array(
      'id_campo' => $id_campo,
      'tag' => $tag,
      'content' => $cont
    ));

    if ($exe) {
      return 1;
    } else { return 0; }

  }
}
