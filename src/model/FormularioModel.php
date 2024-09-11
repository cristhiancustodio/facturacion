<?php

namespace src\Model;
use src\Config\Conexion;

/**
 * 
 * Clase unica para el formulario
 */
class FormularioModel extends Conexion
{
    
    public function insertarFormulario(array $lista){
        $sql = "INSERT INTO formulario (codigo,nombre,id_bodega,id_sucursal,id_moneda,precio,descripcion) 
        values(:codigo,:nombre,:id_bodega,:id_sucursal,:id_moneda, :precio, :descripcion)";
        $resultado = $this->insertar($sql, $lista);
        return $resultado;
    }
    public function insertarMaterialProducto(array $lista){
        $sql = "INSERT INTO det_formulario_producto (id_formulario,id_materialProducto)
        values(:id_formulario,:id_materialProducto)";
        $resultado = $this->multiInsert($sql, $lista);
        return $resultado;
    }
    public function resetMaterialProducto(int $id_formulario){
        $sql = "UPDATE det_formulario_producto SET estado = 0 where id_formulario = :id";
        $lista = [
            ":id" => $id_formulario,
        ];
        $resultado = $this->actualiza($sql, $lista);
        return $resultado;
    }

    /**
     * Datos generales de los registrado
     */
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
