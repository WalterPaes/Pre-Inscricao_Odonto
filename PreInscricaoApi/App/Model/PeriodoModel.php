<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 14:13
 */

namespace Model;

use Database\Database;

class PeriodoModel
{
    // Database Attribute
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function buscarPeriodoAtual()
    {
        return $this->db->select("SELECT * FROM tb_periodos ORDER BY periodo_id DESC LIMIT 1");
    }

    public function buscarPeriodo($id)
    {
        return $this->db->select("SELECT * FROM tb_periodos WHERE periodo_id = :id", [":id" => $id]);
    }
}