<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 14:02
 */

use Model\PreInscricaoModel;
use Response\ResponseJson;
use Communication\Email;
use Exception\NotRegisterSubscriptionException;

class PreInscricao
{
    private $cliente;
    private $unidade;
    private $periodo;
    private $questionario;

    // Model Attributte
    private $preinscricao_model;

    public function __construct(Cliente $clienteObj, Unidade $unidadeObj, Periodo $periodoObj, Questionario $respostas)
    {
        $this->preinscricao_model = new PreInscricaoModel();

        // Setando os atributos
        $this->cliente = $clienteObj;
        $this->unidade = $unidadeObj;
        $this->periodo = $periodoObj;
        $this->questionario = $respostas;
    }

    public function salvar()
    {
        try {
            // Cadastrando o Cliente
            $this->cliente->cadastrarCliente();

            // Verificando se existe uma pré-inscrição do mesmo cliente para o mesmo período
            $verifica = $this->verificaInscricao(
                $this->cliente->getId(),
                $this->periodo->getId()
            );

            // Registrando a Pré-Inscrição
            if ($verifica) {
                // Atualiza os dados da Pré-Inscrição
                $register = $this->preinscricao_model->update(
                    $this->cliente->getId(),
                    $this->unidade->getId(),
                    $this->periodo->getId(),
                    $this->questionario->getRespostas()
                );
            } else {
                // Cadastra os dados da Pré-Inscrição
                $register = $this->preinscricao_model->register(
                    $this->cliente->getId(),
                    $this->unidade->getId(),
                    $this->periodo->getId(),
                    $this->questionario->getRespostas()
                );
            }

            if (!empty($register)) {

                $email = new Email($this->cliente);

                return ResponseJson::response([
                    "status" => 100,
                    "message" => "Pré-Inscrição Efetuada com sucesso! Fique atento e confira a Lista dos Contemplados em até 2 dias úteis no endereço: sesc-pa.com.br"
                ]);
            } else {
                throw new NotRegisterSubscriptionException("Não foi possível registrar a Pré-Inscrição. Tente novamente em alguns minutos");
            }

        } catch (NotRegisterSubscriptionException $ex) {
            return ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    private function verificaInscricao($cliente_id, $periodo_id)
    {
        $result = $this->preinscricao_model->verificaInscricao($cliente_id, $periodo_id);

        if ($result[0]['COUNT(*)'] > 0) {
            return true;
        }

        return false;
    }
}