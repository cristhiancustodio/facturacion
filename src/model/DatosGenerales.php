<?php


namespace src\Model;


use src\Config\Conexion;

/**
 * 
 * Clase unica para los datos generales
 */
class DatosGenerales extends Conexion
{
    public function __construct() {

    }
    public function obtenerBodegas(): array
    {
        $sql = "SELECT * FROM bodega where estado = 1;";
        $resultado = $this->sentencia($sql);
        return $resultado;
    }
    public function obtenerMonedas(): array
    {
        $sql = "SELECT * FROM moneda where estado = 1";
        return $this->sentencia($sql);
    }
    public function obtenerMaterialProducto(): array
    {
        $sql = "SELECT * FROM material_producto where estado = 1";
        return $this->sentencia($sql);
    }

    /**
     * Para el JS
     */
    public function obtenerSucursalAsync(int $id_bodega): array
    {
        $sql = "SELECT * from sucursal where id_bodega=:id";
        $params = [
            ':id' => $id_bodega
        ];
        $resultado = $this->sentencia($sql, $params);
        return $resultado;
    }

    /**
     * Este metodo se llama en el JS para la validacion desde el front y tambien al
     * registrar el formulario en RegistrarFormulario.php
     */
    public function validaCodigoFacturaAsync(string $codigo) : string{
        $sql = "SELECT codigo FROM formulario where codigo = :codigo";
        $params = [
            ':codigo' => $codigo
        ];
        $resultado = $this->sentenciaSimple($sql, $params);
        return $resultado->codigo ?? '';
    }

    
}
