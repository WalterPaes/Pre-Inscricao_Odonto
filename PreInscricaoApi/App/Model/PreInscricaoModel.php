<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 14:14
 */

namespace Model;

use Database\Database;

class PreInscricaoModel
{
    // Database Attribute
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($cliente_id, $unidade_id, $periodo_id, $respostas)
    {
        return $this->db->insert("INSERT INTO tb_preinscricao (preinscricao_cliente, preinscricao_unidade, preinscricao_periodo, preinscricao_respostas) VALUES (:cliente, :unidade, :periodo, :respostas)",
                                           [
                                               ":cliente" => $cliente_id,
                                               ":unidade" => $unidade_id,
                                               ":periodo" => $periodo_id,
                                               ":respostas" => $respostas,
                                           ]
        );
    }

    public function update($cliente_id, $unidade_id, $periodo_id, $respostas)
    {
        return $this->db->update("UPDATE tb_preinscricao SET preinscricao_unidade = :unidade, preinscricao_respostas = :respostas, preinscricao_data = :update_date WHERE preinscricao_cliente = :cliente AND preinscricao_periodo = :periodo",
                                [
                                    ":cliente" => $cliente_id,
                                    ":unidade" => $unidade_id,
                                    ":periodo" => $periodo_id,
                                    ":respostas" => $respostas,
                                    ":update_date" => date('Y-m-d H:i:s')
                                ]
        );
    }

    public function verificaInscricao($cliente_id, $periodo_id)
    {
        return $this->db->select("SELECT COUNT(*) FROM tb_preinscricao WHERE preinscricao_cliente = :id_cliente AND preinscricao_periodo = :id_periodo", [
            ":id_cliente" => $cliente_id,
            ":id_periodo" => $periodo_id
        ]);
    }
}