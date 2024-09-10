<?php

use src\Model\DatosGenerales;

$generales = new DatosGenerales();

$lista_bodega = $generales->obtenerBodegas();
$lista_monedas = $generales->obtenerMonedas();
$lista_material_producto = $generales->obtenerMaterialProducto();
$listado = $generales->listarDatos();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro</title>

    <link rel="stylesheet" href="public/css/style.css?<?= rand()?>" >
    <script src="public/js/jquery/jquery.js"></script>
</head>

<body>
    <form id="formulario">
        <div class="contenedor" >
            <div class="titulo-formulario">
                <h1>Formulario de Producto</h1>
            </div>
            <div class="contenedor-formulario">
                <div class="fila">
                    <div class="columna marg-5">
                        <label for="codigo">Código</label>
                        <input type="text" name="codigo" id="codigo" value="" onblur="verificaCodigoRegistrado(this)" >
                    </div>
                    <div class="columna marg-5">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="">
                    </div>
                </div>
                <div class="fila">
                    <div class="columna marg-5">
                        <label for="">Bodega</label>
                        <select name="id_bodega" id="id_bodega" onchange="obtenerSucural(this)">
                            <option value="" select>Seleccione</option>
                            <?php foreach ($lista_bodega as $key => $value) { ?>
                                <option value="<?= $value->id_bodega; ?>"><?= $value->descripcion ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="columna marg-5">
                        <label for="id_sucursal">Sucursal</label>
                        <select name="id_sucursal" id="id_sucursal">
                            <option value="" select>Seleccione</option>
                        </select>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna marg-5">
                        <label for="id_moneda">Moneda</label>
                        <select name="id_moneda" id="id_moneda">
                            <option value="" select>Seleccione</option>
                            <?php foreach ($lista_monedas as $key => $value) { ?>
                                <option value="<?= $value->id_moneda; ?>"><?= $value->descripcion ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="columna marg-5">
                        <label for="precio">Precio</label>
                        <input type="text" name="precio" id="precio" value="">
                    </div>
                </div>
                <div class="fila">
                    <div class="columna marg-5">
                        <p>Material del Producto</p>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna grid-productos">
                    <?php foreach ($lista_material_producto as $key => $value) { ?>
                        <div class="item-productos">
                            <input type="checkbox" name="id_material_producto[]" class="material_producto" value="<?= $value->id_materialProducto ?? 0 ?>" id="id_producto<?= $value->id_materialProducto ?? 0 ?>">
                            <label class="pad-lr-5" for="id_producto<?= $value->id_materialProducto ?? 0 ?>"><?= $value->descripcion ?? '' ?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="fila">
                    <div class="columna marg-5">

                        <label for="">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3" ></textarea>
                    </div>
                </div>
                <div class="marg-5 div-boton">
                    <button type="submit" class="btn-guardar" >Guardar Producto</button>
                </div>
            </div>
        </div>
    </form>

    <!-- 
    SE QUE NO ESTA EN LA TAREA PERO LO DECIDI HACER
    LA TABLA LO OCULTO EN RESPONSIVE -->

    <table width="80%" align="center" border="1" class="tabla <?= ($listado ?? []) == [] ? "oculta" : ""?>" >
        <thead>
            <tr>
                <td></td>
                <td>Codigo</td>
                <td>Nombre</td>
                <td>Bodega</td>
                <td>Sucursal</td>
                <td>Moneda</td>
                <td>Precio</td>
                <td>Materiales Productos</td>
                <td>Descripcion</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listado ?? [] as $key => $value) {?>
            <tr>
                <td><?= $key + 1?></td>        
                <td><?= $value->codigo ?? ''?></td>        
                <td><?= $value->nombre ?? ''?></td>        
                <td><?= $value->bodega ?? ''?></td>        
                <td><?= $value->sucursal ?? ''?></td>        
                <td><?= $value->moneda ?? ''?></td>        
                <td><?= $value->precio ?? ''?></td>        
                <td><?= $value->materiales ?? ''?></td>        
                <td><?= $value->descripcion ?? ''?></td>        
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>


<script src="public/js/index.js"></script>

<script src="public/js/validacionesFormulario.js"></script>

</html>