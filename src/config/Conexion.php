<?php

declare(strict_types=1);

namespace src\Config;

use PDO;

class Conexion
{
    private static $instancia = null;
    private PDO $con;
    private string $db = 'facturacion';
    private string $usuario = 'root';
    private string $pass = 'luisnunura123456';
    private string $host = 'localhost:3307';

    public static function getInstancia()
    {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function conectar()
    {
        $con = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->usuario, $this->pass);
        $this->con = $con;
        return $this->con;
    }

    public function sentencia(string $sql, array $params = []): array
    {
        $ins = (self::getInstancia())->conectar();
        $stmt = $ins->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($data)) {
            return $data;
        } else {
            return [];
        }
    }
    public function sentenciaSimple(string $sql, array $params = [])
    {
        $ins = (self::getInstancia())->conectar();
        $stmt = $ins->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($data)) {
            return $data;
        } else {
            return null;
        }
    }
    public function insertar($sql, $lista = null)
    {
        $ins = (self::getInstancia())->conectar();
        $stm = $ins->prepare($sql);
        $stm->execute($lista);    
        return $ins->lastInsertId();

    }
    public function actualiza($sql, $lista = null)
    {
        $ins = (self::getInstancia())->conectar();
        $stm = $ins->prepare($sql);
        $stm->execute($lista);    
        return $stm;

    }
    public function multiInsert($sql, $lista = null)
    {
        $ins = (self::getInstancia())->conectar();

        $ins->beginTransaction();

        $stm = $ins->prepare($sql);
        foreach ($lista as $key => $value) {
            $stm->execute($value);
        }

        $ins->commit();

        return $stm;

    }
}
