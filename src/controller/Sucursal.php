<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use src\Model\DatosGenerales;

/**
 * Para obtener la sucursal de acuerdo a la bodega
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $id_bodega = (int)($_GET['id_bodega'] ?? 0);

    try {
        $resultado = (new DatosGenerales())->obtenerSucursalAsync($id_bodega);

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
