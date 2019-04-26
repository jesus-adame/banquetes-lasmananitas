<?php

    Utils::isAdmin();
    require_once '../core/models/TipoEvento.php';
    $tipoEvento = new TipoEvento;

    $res = array(
        'error' => 'true'
    );

    if (isset($_POST['action'])):
        switch ($_POST['action']) {
            case 'insertar':
                if (empty($_POST['nombre'])) {
                    $res['error'] = true;
                    $res['msg'] = 'Debes ingresar un nombre';
                    break;
                }
                $tipoEvento->setNombre($_POST['nombre']);

                try {
                    $tipoEvento->insert();
                    $res['error'] = false;

                } catch (PDOException $e) {
                    $res['error'] = true;
                    $res['msg'] = 'Error al insertar el registro';
                    $res['log'] = $e->getMessage();
                }
                break;

            case 'eliminar':
                if (!isset($_POST['id'])) {
                    $res['error'] = true;
                    $res['msg'] = 'Error PHP';
                    break;
                }
                $tipoEvento->setId($_POST['id']);

                try {
                    $tipoEvento->delete();
                    $res['error'] = false;
                    
                } catch (PDOException $e) {
                    $res['error'] = true;
                    $res['msg'] = 'Error al insertar el registro';
                    $res['log'] = $e->getMessage();
                }
                break;

            default:
                $res['msg'] = 'Tipo evento '. $_POST['id'];
                $res['log'] = $_POST;
                break;
        }
    endif;

?>