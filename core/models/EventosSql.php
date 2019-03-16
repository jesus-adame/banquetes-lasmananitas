<?php

class EventosSql
{
   public function getOrdenSercicio($id = false)
   {
      $data = array();
      $sql = "SELECT * FROM ordenes_servicio";

      if ($id) {
         $data = array('id' => $id);
         $sql .= " WHERE id_orden = :id";
      }
      $rows = Conexion::query($sql, $data, true);
      return $rows;
   }
}

?>