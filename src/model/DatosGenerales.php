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

    public function listarDatos() : array{
        $sql = "SELECT f.id_formulario, f.codigo, f.nombre, f.descripcion,f.precio,
        b.descripcion AS bodega,
        s.descripcion AS sucursal,
        m.descripcion AS moneda
        FROM formulario f
        INNER JOIN bodega b ON b.id_bodega = f.id_bodega
        INNER JOIN sucursal s ON s.id_sucursal = f.id_sucursal
        INNER JOIN moneda m ON m.id_moneda= f.id_moneda

        WHERE f.estado = 1 order by id_formulario desc";

        $resultado = $this->sentencia($sql);
        
        /** En el modelo no va logica debio ir en controlador, pero para hacerlo mas rapido lo hice por aca
         * era dato corto
         * */
        $resultado = array_map(function ($val){
            $val->materiales = implode(", ", array_column($this->materiales((int)$val->id_formulario),"material"));
            return $val;
        }, $resultado);

        return $resultado;
    }
    public function materiales(int $id){
        $sql = "SELECT d.id_materialProducto, m.descripcion as material
        from det_formulario_producto d 
        inner join material_producto m on  m.id_materialProducto = d.id_materialProducto
        where d.id_formulario = :id";
        $params = [
            ":id" => $id
        ];
        $resultado = $this->sentencia($sql, $params);
        return $resultado;
    }
}
