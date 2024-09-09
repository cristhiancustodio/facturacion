<?php
namespace src\Model;
ini_set("display_errors",1);
use src\Config\Conexion;

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

    public function obtenerSucursal(int $id_bodega): array
    {
        $sql = "SELECT * from sucursal where id_bodega=:id";
        $params = [
            ':id' => $id_bodega
        ];
        $resultado = $this->sentencia($sql, $params);
        return $resultado;
    }

    public function validaCodigoFactura(string $codigo) : string{
        $sql = "SELECT codigo FROM formulario where codigo = :codigo";
        $params = [
            ':codigo' => $codigo
        ];
        $resultado = $this->sentenciaSimple($sql, $params);
        return $resultado->codigo ?? '';
    }
}
