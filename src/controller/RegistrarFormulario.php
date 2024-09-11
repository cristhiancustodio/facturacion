<?php
require_once __DIR__ . '/../../vendor/autoload.php';


use src\Model\DatosGenerales;
use src\Model\FormularioModel;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $formulario = new FormularioModel();
    $generales = new DatosGenerales();
    
    try {

        if($generales->validaCodigoFacturaAsync($_POST['codigo']) > 0){
            
            throw new Exception("Este codigo ya está registrado", 1);

        }

        $lista = [
            ":codigo" => ($_POST['codigo'] ?? ''),
            ":nombre" => ($_POST['nombre'] ?? ''),
            ":id_bodega" => ($_POST['id_bodega'] ?? 0),
            ":id_sucursal" => ($_POST['id_sucursal'] ?? 0),
            ":id_moneda" => ($_POST['id_moneda'] ?? 0),
            ":precio" => ((float)$_POST['precio'] ?? 0),
            ":descripcion" => ($_POST['descripcion'] ?? ''),
        ];

        $lista_material_producto = $_POST['id_material_producto'] ?? [];

        $array_material = [];

        $id_formulario = $formulario->insertarFormulario($lista);

        if ($id_formulario > 0) {
            /**Si se registra formulario agregaremos los materiales en una nueva tabla */
            foreach ($lista_material_producto as $key => $value) {
                $array_material[$key][":id_formulario"] = $id_formulario;
                $array_material[$key][":id_materialProducto"] = $value;
            }
            if ($array_material !== []) {
                $result2 = $formulario->insertarMaterialProducto($array_material);
            }

            $mensaje = 'Registrado correctamente';
        }else{
            throw new Exception("No se pudo registrar", 1);
        }

        echo json_encode(
            [
                "estado" => 'exito',
                "resultado" => $id_formulario,
                "mensaje" => $mensaje ?? '',
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
