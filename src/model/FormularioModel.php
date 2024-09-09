<?php

namespace src\Model;
use src\Config\Conexion;

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
}
