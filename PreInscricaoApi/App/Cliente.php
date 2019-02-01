<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 13:57
 */

use Model\ClienteModel;
use Response\ResponseJson;
use Exception\NotRegisterClientException;
use Exception\NotUpdateClientException;
use Exception\InvalidNameLengthException;
use Exception\InvalidAgeException;
use Exception\InvalidMatLengthException;
use Exception\InvalidMatException;
use Exception\InvalidPhoneLengthException;
use Exception\InvalidEmailException;
use Exception\InvalidCategoryException;

class Cliente
{
    private $id;
    private $nome;
    private $idade;
    private $matricula;
    private $categoria;
    private $telefone;
    private $email;

    // Database Attribute
    private $cliente_model;

    public function __construct($nome, $idade, $matricula, $categoria, $telefone, $email = null)
    {
        $this->cliente_model = new ClienteModel();

        // Registra os dados do cliente e seta os parâmetros
        $this->setNome($nome);
        $this->setIdade($idade);
        $this->setMatricula($matricula);
        $this->setCategoria($categoria);
        $this->setTelefone($telefone);
        $this->setEmail($email);
    }

    public function cadastrarCliente()
    {
        try {

            $result = $this->cliente_model->find($this->matricula);

            if (empty($result)) {
                $register = $this->cliente_model->register($this->nome, $this->idade, $this->matricula, $this->categoria, $this->telefone, $this->email);
                if (!empty($register)) {
                    $this->id = $register;
                } else {
                    throw new NotRegisterClientException("Não foi possível realizar o Cadastro do Cliente");
                }

            } else {
                $this->id = $result[0]['cliente_id'];
                $register = $this->cliente_model->update($this->id, $this->nome, $this->idade, $this->matricula, $this->categoria, $this->telefone, $this->email);
                if (empty($register)) {
                    throw new NotUpdateClientException("Não foi possível atualizar o Cadastro do Cliente");
                }

            }
        } catch (NotRegisterClientException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        } catch (NotUpdateClientException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }

    }

    // Métodos GETTERS AND SETTERS

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        try {
            // Fazendo a limpeza do dado enviado por parâmetro
            $nome = mb_strtoupper(filter_var($nome, FILTER_SANITIZE_STRING));

            // Verificando se o Nome é válido
            if (strlen($nome) < 2) {
                throw new InvalidNameLengthException("O campo nome não pode conter menos que dois caracteres!");
            }

            $this->nome = $nome;

        } catch (InvalidNameLengthException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        try {
            // Fazendo a limpeza do dado enviado por parâmetro
            $idade = filter_var($idade, FILTER_SANITIZE_NUMBER_INT);

            // Verificando se a idade é válida (Se for um número inteiro e se for maior que 0 e menor que 111)
            if (! filter_var($idade, FILTER_VALIDATE_INT, ["min_range" => 1, "max_range" => 110]) ) {
                throw new InvalidAgeException("Idade Inválida!");
            }

            $this->idade = $idade;

        } catch (InvalidAgeException $ex){
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function getMatricula()
    {
        return $this->matricula;
    }

    public function setMatricula($matricula)
    {
        try {
            // Fazendo a limpeza do dado enviado por parâmetro
            $matricula = filter_var($matricula, FILTER_SANITIZE_STRING);

            // Verificando se a matrícula é válida (11 caracteres do tipo inteiro)
            if (! filter_var($matricula, FILTER_SANITIZE_NUMBER_INT) ) {
                throw new InvalidMatException("Matrícula Inválida!");
            } elseif ( strlen($matricula) != 11 ) {
                throw new InvalidMatLengthException("A matrícula deve conter exatamente 11 caracteres numéricos!");
            }

            $this->matricula = $matricula;

        } catch (InvalidMatException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        } catch (InvalidMatLengthException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        try {
            $categoria = filter_var($categoria, FILTER_SANITIZE_NUMBER_INT);

            if (!filter_var($categoria, FILTER_SANITIZE_NUMBER_INT, ["min_range" => 1, "max_range" => 5])) {
                throw new InvalidCategoryException("Categoria Inválida!");
            }

            $this->categoria = $categoria;
        } catch (InvalidCategoryException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        try {
            $telefone = filter_var($telefone, FILTER_SANITIZE_NUMBER_INT);

            if(strlen($telefone) < 10 || strlen($telefone) > 11 ) {
                throw new InvalidPhoneLengthException("O telefone deve ter no mínimo 10 e no máximo 11 caracteres numéricos!");
            }

            $this->telefone = $telefone;

        } catch (InvalidPhoneLengthException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        try {

            if ($email != null || $email == '') {
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new InvalidEmailException("O email informado é inválido");
                }
            }

            $this->email = $email;

        } catch (InvalidEmailException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }
}