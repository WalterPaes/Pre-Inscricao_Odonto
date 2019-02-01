<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 13:52
 */

use Model\PeriodoModel;
use Response\ResponseJson;
use Helper\DateTimeHelper;
use Exception\InvalidPeriodException;
use Exception\NotHavePeriodsException;
use Exception\OutOfPeriodException;

class Periodo
{
    private $id;
    private $ano;
    private $mes;
    private $inicio;
    private $fim;

    // Atributo Model
    private $periodo_model;

    public function __construct($id = null)
    {
        $this->periodo_model = new PeriodoModel();

        // Setando o Id do Período
        $this->setId($id);

        // Executa o método que busca os dados do período atual no Banco de Dados
        $this->buscaPeriodo($this->getId());
    }

    // Busca na Base de Dados o Período disponível e seta os parâmetros
    private function buscaPeriodo($id)
    {
        try {

            // Se o $id for nulo, o sistema busca o último período registrado. Se não, buscará o período indicado
            if ($id == null) {
                $periodo = $this->periodo_model->buscarPeriodoAtual();
            } else {
                $periodo = $this->periodo_model->buscarPeriodo($id);
            }

            // Se existir registro de período
            if (!empty($periodo)) {
                // Seta os atributos
                $this->id = $periodo[0]['periodo_id'];
                $this->ano = $periodo[0]['periodo_ano'];
                $this->mes = $periodo[0]['periodo_mes'];
                $this->inicio = $periodo[0]['periodo_inicio'];
                $this->fim = $periodo[0]['periodo_fim'];
            } else {
                throw new NotHavePeriodsException("Não existem períodos cadastrados!");
            }

        } catch (NotHavePeriodsException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function verificaPeriodo()
    {
        try {
            $atual = DateTimeHelper::getTimeStamp(date("Y-m-d H:i:s"));
            $inicio = DateTimeHelper::getTimeStamp($this->getInicio());
            $fim = DateTimeHelper::getTimeStamp($this->getFim());

            if ($atual >= $inicio && $atual <= $fim) {
                return ResponseJson::response([
                    "status" => 100,
                    "periodo" => $this->getId()
                ]);
            } else {
                throw new OutOfPeriodException("Fora do Período de Pré-Inscrição!");
            }
        } catch (OutOfPeriodException $ex) {
            return ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    // Métodos GET

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        try {

            if ($id != null) {
                $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

                if (!filter_var($id, FILTER_VALIDATE_INT)) {
                    throw new InvalidPeriodException("Período Inválido!");
                }
            }

            $this->id = $id;
        } catch (InvalidPeriodException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function getAno()
    {
        return $this->ano;
    }

    public function getMes()
    {
        return $this->mes;
    }

    public function getInicio()
    {
        return $this->inicio;
    }

    public function getFim()
    {
        return $this->fim;
    }
}