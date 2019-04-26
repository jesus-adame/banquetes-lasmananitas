<?php

    class TipoEvento {
        private $id;
        private $nombre;

        public function setId($id) {
            $this->id = $id;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function insert() {
            $sql = "INSERT INTO tipo_eventos VALUES (null, ?)";
            Conexion::query($sql, array($this->nombre));
        }

        public function delete() {
            $sql = "DELETE FROM tipo_eventos WHERE id_tipo_evento = ?";
            Conexion::query($sql, array($this->id));
        }

        public function getAll() {
            $sql = "SELECT * FROM tipo_eventos";
            return Conexion::query($sql, array(), true);
        }
    }

?>