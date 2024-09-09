<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use src\Model\DatosGenerales;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id_bodega = (int)($_POST['id_bodega']);
    try {
        $resultado = (new DatosGenerales())->obtenerSucursal($id_bodega);

        $mensaje = '';
        echo json_encode(
            [
                "estado" => 'exito',
                "resultado" => $resultado,
                "mensaje" => $mensaje,
            ]
        );
    } catch (Exception $e) {
        echo json_encode(
            [
                "estado" => 'error',
                "mensaje" => $e->getMessage(),
            ]
        );
    }
}
