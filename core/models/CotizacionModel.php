<?php
class Cotizacion
{
    private $data = array();

    function __construct($data)
    {
        $this->data = $data;
    }

    function verificarEspacio() {
        $sql = "SELECT * FROM eventos WHERE :inicio BETWEEN start and end AND id_lugar = :id_lugar AND color = '#e62424'";

        $new_data = array(
            'inicio' => $this->data['fecha_inicio'],
            'id_lugar' => $this->data['id_lugar']
        );

        $res1 = Conexion::query($sql, $new_data, true, false);

        if (sizeof($res1) >= 1) {
            return $res1;
        } else {
            $sql = "SELECT * FROM eventos WHERE :final BETWEEN start and end AND id_lugar = :id_lugar AND color = '#e62424'";

            $new_data = array(
                'final' => $this->data['fecha_final'],
                'id_lugar' => $this->data['id_lugar']
            );

            $res2 = Conexion::query($sql, $new_data, true, false);

            if (sizeof($res2) >= 1) {
                return $res2;
            } else {
                $sql = "SELECT * FROM eventos WHERE ((start between :inicio and :final) OR 
                (end between :inicio and :final)) AND id_lugar = :id_lugar; AND color = '#e62424'";

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
}
