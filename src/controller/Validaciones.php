<?php

use src\Model\DatosGenerales;

require_once __DIR__ . '/../../vendor/autoload.php';


$datos = new DatosGenerales();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $codigo = $_GET['codigo'] ?? '';

    $resultado = $datos->validaCodigoFactura($codigo);

    if($resultado != ''){
        echo json_encode([
            "respuesta" => $resultado,
            "mensaje" => 'Este registro existe',
            "estado" => 1
        ]);
    }else{
        echo json_encode([
            "estado" => 0,
            "respuesta" => '',
            "mensaje" => 'No hay registro',
        ]);
    }

}
