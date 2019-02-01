<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 24/01/2019
 * Time: 12:59
 */

namespace Database;

use Response\ResponseJson;

class Database
{
    // Constantes referentes à base de dados
    const DB_HOST = 'YOUR_HOST';
    const DB_BASE = 'YOUR_DB';
    const DB_USER = 'YOUR_USER';
    const DB_PASS = 'YOUR_PASS';

    // Atributo responsável pelo objeto de conexão
    private $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO(
                "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_BASE . ";charset=utf8mb4",
                self::DB_USER,
                self::DB_PASS
            );

            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage(),
                "trace" => $ex->getFile(),
                "line" => $ex->getLine()
            ]);
        }
    }

    // Método responsável por executar os SELECT's no Banco de Dados
    public function select($query, $params = array())
    {
        try {
            $select = $this->query($query, $params);
            return $select->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage(),
                "trace" => $ex->getFile(),
                "line" => $ex->getLine()
            ]);
        }
    }

    // Método responsável por realizar INSERT's no banco de dados
    public function insert($sql_query, $params = array()) {
        try {
            $this->query($sql_query, $params);
            $insert_id = $this->db->lastInsertId();
            return $insert_id;
        } catch (\PDOException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage(),
                "trace" => $ex->getFile(),
                "line" => $ex->getLine()
            ]);
        }
    }

    // Método responsável por realizar UPDATE's no banco de dados
    public function update($sql_query, $params = array()) {
        try {
            $update = $this->query($sql_query, $params);
            $affectedRows = $update->rowCount();
            return $affectedRows;
        } catch (\PDOException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage(),
                "trace" => $ex->getFile(),
                "line" => $ex->getLine()
            ]);
        }
    }

    // Método que Executa a query
    public function query($query, $params = array())
    {
        try {
            $stmt = $this->db->prepare($query);
            $this->setParams($stmt, $params);
            $stmt->execute();
            return $stmt;
        } catch (\PDOException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage(),
                "trace" => $ex->getFile(),
                "line" => $ex->getLine()
            ]);
        }
    }

    private function setParams($statement, $params = array())
    {
        foreach ($params as $key => $value)
        {
            $this->bindParams($statement, $key, $value);
        }
    }

    private function bindParams($statment, $bind, $value)
    {
        try {
            $statment->bindParam($bind, $value);
        } catch (\PDOException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage(),
                "trace" => $ex->getFile(),
                "line" => $ex->getLine()
            ]);
        }
    }
}