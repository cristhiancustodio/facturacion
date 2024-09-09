<?php

use src\Model\DatosGenerales;

$generales = new DatosGenerales();

$lista_bodega = $generales->obtenerBodegas();
$lista_monedas = $generales->obtenerMonedas();
$lista_material_producto = $generales->obtenerMaterialProducto();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro</title>


    <script src="public/js/jquery/jquery.js"></script>
</head>

<body>
    <form id="formulario">
        <div>
            <h1>Formulario de Producto</h1>


            <div class="">
                <div class="">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo" value="" onblur="verificaCodigoRegistrado(this)" >
                </div>
                <div class="">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="">
                </div>
            </div>
            <div class="">
                <div class="">
                    <label for="">Bodega</label>
                    <select name="id_bodega" id="id_bodega" onchange="obtenerSucural(this)">
                        <option value="" select>[SELECCIONE]</option>
                        <?php foreach ($lista_bodega as $key => $value) { ?>
                            <option value="<?= $value->id_bodega; ?>"><?= $value->descripcion ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="">
                    <label for="id_sucursal">Sucursal</label>
                    <select name="id_sucursal" id="id_sucursal">
                        <option value="" select>[SELECCIONE]</option>
                    </select>
                </div>
            </div>
            <div class="">
                <div class="">
                    <label for="id_moneda">Moneda</label>
                    <select name="id_moneda" id="id_moneda">
                        <option value="" select>[SELECCIONE]</option>
                        <?php foreach ($lista_monedas as $key => $value) { ?>
                            <option value="<?= $value->id_moneda; ?>"><?= $value->descripcion ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" value="">
                </div>
            </div>

            <div class="">
                <?php foreach ($lista_material_producto as $key => $value) { ?>
                    <label for="id_producto<?= $value->id_materialProducto ?? 0 ?>"><?= $value->descripcion ?? '' ?></label>
                    <input type="checkbox" name="id_material_producto[]" class="material_producto" value="<?= $value->id_materialProducto ?? 0 ?>" id="id_producto<?= $value->id_materialProducto ?? 0 ?>">
                <?php } ?>
            </div>

            <div class="">
                <label for="">Descripcioón</label>
                <textarea name="descripcion" id="descripcion"></textarea>
            </div>
            <div class="">
                <button type="submit">Guardar Producto</button>
            </div>
        </div>
    </form>
</body>


<script src="public/js/index.js"></script>

<script src="public/js/validacionesFormulario.js"></script>

</html>