<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 14:13
 */

namespace Model;

use Database\Database;

class ClienteModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function find($matricula)
    {
        return $this->db->select("SELECT * FROM tb_clientes WHERE cliente_matricula = :matricula", [
            ":matricula" => $matricula
        ]);
    }

    public function register($nome, $idade, $matricula, $categoria, $telefone, $email)
    {
        return $this->db->insert("INSERT INTO tb_clientes (cliente_nome, cliente_idade, cliente_matricula, cliente_categoria, cliente_telefone, cliente_email) VALUES (:nome, :idade, :matricula, :categoria, :telefone, :email)",
           [
               ":nome" => $nome,
               ":idade" => $idade,
               ":matricula" => $matricula,
               ":categoria" => $categoria,
               ":telefone" => $telefone,
               ":email" => $email
           ]
        );
    }

    public function update($id, $nome, $idade, $matricula, $categoria, $telefone, $email)
    {
        return $this->db->update("UPDATE tb_clientes SET cliente_nome = :nome, cliente_idade = :idade, cliente_matricula = :matricula, cliente_categoria = :categoria, cliente_telefone = :telefone, cliente_email = :email, cliente_update = :update_date WHERE cliente_id = :id",
            [
                ":nome" => $nome,
                ":idade" => $idade,
                ":matricula" => $matricula,
                ":categoria" => $categoria,
                ":telefone" => $telefone,
                ":email" => $email,
                ":update_date" => date("Y-m-d H:i:s"),
                ":id" => $id,
            ]
        );
    }
}