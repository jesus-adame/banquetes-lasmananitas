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

  public function agregarOrden($datos)
  {
    if ($this->obtenerValidacionEvento($_SESSION['id_usuario'], $datos[0])
    || $_SESSION['puesto'] == 'Administrador') {
      $sql = "INSERT INTO ordenes_servicio (
        id_evento,
        fecha,
        orden,
        lugar,
        montaje,
        canapes,
        entrada,
        fuerte,
        postre,
        bebidas,
        cocteleria,
        mezcladores,
        detalle_montaje,
        ama_llaves,
        chief_steward,
        mantenimiento,
        seguridad,
        recursos_humanos,
        proveedores,
        contabilidad,
        observaciones,
        tipo_formato,
        garantia) VALUES (
        :id_evento,
        :fecha,
        :evento,
        :lugar,
        :montaje,
        :canapes,
        :entrada,
        :fuerte,
        :postre,
        :bebidas,
        :cocteleria,
        :mezcladores,
        :detalle_montaje,
        :ama_llaves,
        :chief_steward,
        :mantenimiento,
        :seguridad,
        :recursos_humanos,
        :proveedores,
        :contabilidad,
        :observaciones,
        :tipo_formato,
        :garantia)";
  
      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'id_evento' => $datos[0],
        'fecha' => $datos[1],
        'evento' => $datos[2],
        'lugar' => $datos[3],
        'montaje' => $datos[4],
        'canapes' => $datos[5],
        'entrada' => $datos[6],
        'fuerte' => $datos[7],
        'postre' => $datos[8],
        'bebidas' => $datos[9],
        'cocteleria' => $datos[10],
        'mezcladores' => $datos[11],
        'detalle_montaje' => $datos[12],
        'ama_llaves' => $datos[13],
        'mantenimiento' => $datos[14],
        'seguridad' => $datos[15],
        'recursos_humanos' => $datos[16],
        'proveedores' => $datos[17],
        'contabilidad' => $datos[18],
        'garantia' => $datos[19],
        'chief_steward' => $datos[20],
        'observaciones' => $datos[21],
        'tipo_formato' => $datos[22]
      ));
  
      return $this->db->lastInsertId();
    } else { return 0; }
    
  }

  public function eliminarOrden($id, $id_evento)
  {
    if ($this->obtenerValidacionEvento($_SESSION['id_usuario'], $id_evento)
    || $_SESSION['puesto'] == 'Administrador') {
      $sql = "DELETE FROM
      ordenes_servicio WHERE id_orden = :id";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'id' => $id
      ));

      return $exe;
    } else {return 0; }
  }

  public function modificarOrden($id, $datos)
  {
    if ($this->obtenerValidacionEvento($_SESSION['id_usuario'], $datos[0])
    || $_SESSION['puesto'] == 'Administrador') {
      $sql = "UPDATE ordenes_servicio SET
      id_evento = :id_evento,
      fecha = :fecha,
      orden = :nombre,
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
      mantenimiento = :mantenimiento,
      seguridad = :seguridad,
      recursos_humanos = :recursos_humanos,
      proveedores = :proveedores,
      contabilidad = :contabilidad,
      garantia = :garantia,
      chief_steward = :chief_steward,
      observaciones = :observaciones,
      tipo_formato = :tipo_formato WHERE id_orden = :id";

      $exe = $this->db->prepare($sql);
      $exe->execute(array(
        'id_evento' => $datos[0],
        'fecha' => $datos[1],
        'nombre' => $datos[2],
        'lugar' => $datos[3],
        'montaje' => $datos[4],
        'canapes' => $datos[5],
        'entrada' => $datos[6],
        'fuerte' => $datos[7],
        'postre' => $datos[8],
        'bebidas' => $datos[9],
        'cocteleria' => $datos[10],
        'mezcladores' => $datos[11],
        'detalle_montaje' => $datos[12],
        'ama_llaves' => $datos[13],
        'mantenimiento' => $datos[14],
        'seguridad' => $datos[15],
        'recursos_humanos' => $datos[16],
        'proveedores' => $datos[17],
        'contabilidad' => $datos[18],
        'garantia' => $datos[19],
        'chief_steward' => $datos[20],
        'observaciones' => $datos[21],
        'tipo_formato' => $datos[22],
        'id' => $id
      ));

      return $exe;
    } else { return 0; }
    
  }

  private function obtenerValidacionEvento($id_usu, $id_evento)
  {
    $sql = "SELECT COUNT(*) FROM eventos
    WHERE id_usuario = :id_usu AND id_evento = :id_evento";

    $exe = $this->db->prepare($sql);
    $exe->execute(array(
      'id_usu' => $id_usu,
      'id_evento' => $id_evento
    ));

    return $exe->fetchColumn();
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
