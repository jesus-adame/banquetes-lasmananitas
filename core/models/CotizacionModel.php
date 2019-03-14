<?php
class Cotizacion
{
    private $data = array();

    function __construct($data)
    {
        $this->data = $data;
    }

    function verificarEspacio() {
        $sql = "SELECT * FROM eventos WHERE :inicio BETWEEN start and end AND id_lugar = :id_lugar AND color != '#d7c735'";

        $new_data = array(
            'inicio' => $this->data['fecha_inicio'],
            'id_lugar' => $this->data['id_lugar']
        );

        $res1 = Conexion::query($sql, $new_data, true, false);

        if (sizeof($res1, 0) >= 1) {
            return $res1;
        } else {
            $sql = "SELECT * FROM eventos WHERE :final BETWEEN start and end AND id_lugar = :id_lugar AND color != '#d7c735'";

            $new_data = array(
                'final' => $this->data['fecha_final'],
                'id_lugar' => $this->data['id_lugar']
            );

            $res2 = Conexion::query($sql, $new_data, true, false);

            if (sizeof($res2, 0) >= 1) {
                return $res2;
            } else {
                $sql = "SELECT * FROM eventos WHERE ((start between :inicio and :final) OR 
                (end between :inicio and :final)) AND id_lugar = :id_lugar; AND color != '#d7c735'";

                $new_data = array(
                    'inicio' => $this->data['fecha_inicio'],
                    'final' => $this->data['fecha_final'],
                    'id_lugar' => $this->data['id_lugar']
                );

                $res3 = Conexion::query($sql, $new_data, true, false);

                return $res3;
            }
        }
    }

    function crearLog($tipo_evento) {
        $res = 0;
        $sql1 = 'SELECT cliente FROM cot_renta
        WHERE cliente = :cliente AND email = :email AND tipo_evento = :tipo_evento AND lugar = :lugar AND fecha_inicio LIKE :fecha_inicio AND fecha_final LIKE :fecha_final;';

        $data1 = array(
            'cliente' => $this->data['cliente'],
            'email' => $this->data['email'],
            'tipo_evento' => intval($tipo_evento),
            'lugar' => $this->data['id_lugar'],
            'fecha_inicio' => $this->data['fecha_inicio'].'%',
            'fecha_final' => $this->data['fecha_final'].'%'
        );

        $validacion = Conexion::query($sql1, $data1, true);

        if (sizeof($validacion, 0) <= 0) {
            $sql = 'INSERT INTO cot_renta (cliente, telefono, email, pax, tipo_evento, lugar, fecha_inicio, fecha_final) VALUES (:cliente, :telefono, :email, :pax, :tipo_evento, :lugar, :fecha_inicio, :fecha_final);';

            $new_data = array(
                'cliente' => $this->data['cliente'],
                'telefono' => $this->data['telefono'],
                'email' => $this->data['email'],
                'pax' => $this->data['pax'],
                'tipo_evento' => intval($tipo_evento),
                'lugar' => $this->data['id_lugar'],
                'fecha_inicio' => $this->data['fecha_inicio'],
                'fecha_final' => $this->data['fecha_final']
            );

            $res = Conexion::query($sql, $new_data, false, false);
        }    

        return $validacion;
    }
}
