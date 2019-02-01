<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 14:13
 */

namespace Model;

use Database\Database;

class UnidadeModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all()
    {
        return $this->db->select("SELECT * FROM tb_unidades WHERE unidade_status = :status", [
            ":status" => 1
        ]);
    }

    public function find($unidade_id)
    {
        return $this->db->select("SELECT * FROM tb_unidades WHERE unidade_id = :id", [
            ":id" => $unidade_id
        ]);
    }
}