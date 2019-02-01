<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 14:08
 */

use Model\UnidadeModel;
use Response\ResponseJson;
use Exception\InvalidUniException;

class Unidade
{
    private $id;
    private $nome;
    private $img;

    // Model
    private $unidade_model;

    public function __construct($id = null)
    {
        $this->unidade_model = new UnidadeModel();

        $this->setId($id);
    }

    public function listarUnidades()
    {
        // Busca na Base de dados e lista todas Unidades ativas
        return $this->unidade_model->all();
    }

    public function buscaUnidade()
    {
        // Busca na Base de dados e seta os parâmetros da Unidade encontrada
        return $this->unidade_model->find($this->getId());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        try {

            if ($id != null) {
                $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

                if (!filter_var($id, FILTER_VALIDATE_INT) || ($id < 0 || $id > count($this->listarUnidades()))) {
                    throw new InvalidUniException("Unidade Inválida!");
                }
            }

            $this->id = $id;

        } catch (InvalidUniException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getImg()
    {
        return $this->img;
    }
}